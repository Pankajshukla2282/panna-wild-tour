<?php

namespace PWT\Bookings;

defined('ABSPATH') || exit;

class AjaxBooking
{
	public function register(): void
	{
		add_action('wp_ajax_pwt_submit_booking', [$this, 'submit']);
		add_action('wp_ajax_nopriv_pwt_submit_booking', [$this, 'submit']);
		add_action('wp_ajax_pwt_quote_booking', [$this, 'quote']);
		add_action('wp_ajax_nopriv_pwt_quote_booking', [$this, 'quote']);
	}

	public function quote(): void
	{
		check_ajax_referer('pwt_booking_nonce', 'nonce');

		$packageId = absint($_POST['package_id'] ?? 0);
		$persons = absint($_POST['persons'] ?? 0);
		$travelDate = sanitize_text_field($_POST['travel_date'] ?? '');

		if (!$packageId || !$persons || !$travelDate) {
			wp_send_json_error([
				'message' => __('Package, date, and person count are required for estimate.', 'panna-wild-tour')
			], 422);
		}

		$estimate = \PWT\Frontend\Pricing::calculateEstimate($packageId, $persons, $travelDate);

		wp_send_json_success($estimate);
	}

	public function submit(): void
	{
		check_ajax_referer('pwt_booking_nonce', 'nonce');

		$name = sanitize_text_field($_POST['name'] ?? '');
		$phone = sanitize_text_field($_POST['phone'] ?? '');
		$email = sanitize_email($_POST['email'] ?? '');
		$travelDate = sanitize_text_field($_POST['travel_date'] ?? '');
		$persons = absint($_POST['persons'] ?? 0);
		$packageId = absint($_POST['package_id'] ?? 0);
		$message = sanitize_textarea_field($_POST['message'] ?? '');

		if (!$name || !$phone || !$travelDate || $persons < 1) {
			wp_send_json_error([
				'message' => __('Please complete all required fields.', 'panna-wild-tour')
			], 422);
		}

		if ($packageId && !\PWT\Frontend\AvailabilityCalendar::isDateAvailable($packageId, $travelDate)) {
			wp_send_json_error([
				'message' => __('Selected date is unavailable for this package.', 'panna-wild-tour')
			], 409);
		}

		$bookingId = wp_insert_post([
			'post_type' => 'pwt_booking',
			'post_status' => 'publish',
			'post_title' => sprintf(
				/* translators: 1: customer name, 2: booking date */
				__('%1$s - %2$s', 'panna-wild-tour'),
				$name,
				current_time('mysql')
			),
		], true);

		if (is_wp_error($bookingId)) {
			wp_send_json_error([
				'message' => __('Unable to save booking request.', 'panna-wild-tour')
			], 500);
		}

		update_post_meta($bookingId, '_pwt_name', $name);
		update_post_meta($bookingId, '_pwt_phone', $phone);
		update_post_meta($bookingId, '_pwt_email', $email);
		update_post_meta($bookingId, '_pwt_travel_date', $travelDate);
		update_post_meta($bookingId, '_pwt_persons', $persons);
		update_post_meta($bookingId, '_pwt_package_id', $packageId);
		update_post_meta($bookingId, '_pwt_message', $message);

		$estimate = [];
		$payment = [];

		if ($packageId) {
			$estimate = \PWT\Frontend\Pricing::calculateEstimate($packageId, $persons, $travelDate);
			update_post_meta($bookingId, '_pwt_estimated_total', $estimate['estimated_total'] ?? 0);
			update_post_meta($bookingId, '_pwt_estimate_season', $estimate['season_label'] ?? '');

			if (!empty($estimate['estimated_total'])) {
				$payment = \PWT\Payments\PaymentManager::createIntent($bookingId, (float) $estimate['estimated_total']);
			}
		}

		$settings = get_option('pwt_settings', []);
		$recipient = $settings['booking_email'] ?? get_option('admin_email');

		$packageName = $packageId ? get_the_title($packageId) : __('Not selected', 'panna-wild-tour');

		$subject = \PWT\Bookings\EmailTemplates::bookingAdminSubject($name);
		$body = \PWT\Bookings\EmailTemplates::bookingAdminBody([
			'name' => $name,
			'phone' => $phone,
			'email' => $email,
			'travel_date' => $travelDate,
			'persons' => $persons,
			'package_name' => $packageName,
			'message' => $message,
			'estimated_total' => $estimate['formatted_total'] ?? '',
			'payment_link' => $payment['payment_url'] ?? '',
		]);

		wp_mail($recipient, $subject, $body);

		wp_send_json_success([
			'message' => __('Thank you. Our team will contact you shortly.', 'panna-wild-tour'),
			'payment_url' => $payment['payment_url'] ?? '',
			'payment_advance_amount' => $payment['advance_amount'] ?? 0,
		]);
	}
}
