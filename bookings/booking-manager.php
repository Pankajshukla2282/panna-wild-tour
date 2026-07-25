<?php

namespace PWT\Bookings;

defined('ABSPATH') || exit;

class BookingManager
{
	public function register(): void
	{
		add_action('init', [$this, 'registerPostType']);
		add_filter('manage_pwt_booking_posts_columns', [$this, 'columns']);
		add_action('manage_pwt_booking_posts_custom_column', [$this, 'columnValue'], 10, 2);
		add_action('add_meta_boxes', [$this, 'addMetaBoxes']);
		add_action('save_post_pwt_booking', [$this, 'saveMetaBox']);
	}

	public function registerPostType(): void
	{
		register_post_type('pwt_booking', [
			'labels' => [
				'name' => __('Bookings', 'panna-wild-tour'),
				'singular_name' => __('Booking', 'panna-wild-tour'),
				'add_new_item' => __('Add Booking', 'panna-wild-tour'),
				'edit_item' => __('Edit Booking', 'panna-wild-tour'),
			],
			'public' => false,
			'show_ui' => true,
			'show_in_menu' => 'pwt-dashboard',
			'menu_icon' => 'dashicons-clipboard',
			'supports' => ['title'],
			'capability_type' => 'post',
			'map_meta_cap' => true,
		]);
	}

	public function columns(array $columns): array
	{
		unset($columns['date']);

		$columns['name'] = __('Name', 'panna-wild-tour');
		$columns['phone'] = __('Phone', 'panna-wild-tour');
		$columns['travel_date'] = __('Travel Date', 'panna-wild-tour');
		$columns['persons'] = __('Persons', 'panna-wild-tour');
		$columns['estimate'] = __('Estimated Total', 'panna-wild-tour');
		$columns['payment_status'] = __('Payment Status', 'panna-wild-tour');
		$columns['date'] = __('Submitted', 'panna-wild-tour');

		return $columns;
	}

	public function columnValue(string $column, int $postId): void
	{
		switch ($column) {
			case 'name':
				echo esc_html((string) get_post_meta($postId, '_pwt_name', true));
				break;

			case 'phone':
				echo esc_html((string) get_post_meta($postId, '_pwt_phone', true));
				break;

			case 'travel_date':
				echo esc_html((string) get_post_meta($postId, '_pwt_travel_date', true));
				break;

			case 'persons':
				echo esc_html((string) get_post_meta($postId, '_pwt_persons', true));
				break;

			case 'estimate':
				$estimate = (float) get_post_meta($postId, '_pwt_estimated_total', true);
				if ($estimate > 0) {
					echo esc_html('INR ' . number_format_i18n($estimate, 0));
				} else {
					esc_html_e('N/A', 'panna-wild-tour');
				}
				break;

			case 'payment_status':
				$status = (string) get_post_meta($postId, '_pwt_payment_status', true);
				echo esc_html(\PWT\Payments\PaymentManager::statusLabel($status));
				break;
		}
	}

	public function addMetaBoxes(): void
	{
		add_meta_box(
			'pwt-booking-payment',
			__('Booking Payment Status', 'panna-wild-tour'),
			[$this, 'renderPaymentMetaBox'],
			'pwt_booking',
			'side'
		);
	}

	public function renderPaymentMetaBox(\WP_Post $post): void
	{
		wp_nonce_field('pwt_booking_payment_meta', 'pwt_booking_payment_nonce');

		$status = (string) get_post_meta($post->ID, '_pwt_payment_status', true);
		$reference = (string) get_post_meta($post->ID, '_pwt_payment_reference', true);
		$method = (string) get_post_meta($post->ID, '_pwt_payment_method', true);
		$dueAmount = (float) get_post_meta($post->ID, '_pwt_payment_due_amount', true);
		$paymentUrl = '';
		$token = (string) get_post_meta($post->ID, '_pwt_payment_token', true);

		if ($token) {
			$paymentUrl = \PWT\Payments\PaymentManager::paymentUrl($token);
		}
		?>
		<p>
			<label for="pwt_payment_status"><strong><?php esc_html_e('Status', 'panna-wild-tour'); ?></strong></label>
			<select name="pwt_payment_status" id="pwt_payment_status" class="widefat">
				<option value="pending_payment" <?php selected($status, 'pending_payment'); ?>><?php esc_html_e('Pending Payment', 'panna-wild-tour'); ?></option>
				<option value="verification_pending" <?php selected($status, 'verification_pending'); ?>><?php esc_html_e('Verification Pending', 'panna-wild-tour'); ?></option>
				<option value="partial_paid" <?php selected($status, 'partial_paid'); ?>><?php esc_html_e('Advance Received', 'panna-wild-tour'); ?></option>
				<option value="paid" <?php selected($status, 'paid'); ?>><?php esc_html_e('Paid in Full', 'panna-wild-tour'); ?></option>
				<option value="failed" <?php selected($status, 'failed'); ?>><?php esc_html_e('Failed', 'panna-wild-tour'); ?></option>
				<option value="cancelled" <?php selected($status, 'cancelled'); ?>><?php esc_html_e('Cancelled', 'panna-wild-tour'); ?></option>
			</select>
		</p>
		<p><strong><?php esc_html_e('Advance Due', 'panna-wild-tour'); ?>:</strong> <?php echo esc_html($dueAmount > 0 ? 'INR ' . number_format_i18n($dueAmount, 0) : 'N/A'); ?></p>
		<p><strong><?php esc_html_e('Payment Method', 'panna-wild-tour'); ?>:</strong> <?php echo esc_html($method ?: __('Not submitted', 'panna-wild-tour')); ?></p>
		<p><strong><?php esc_html_e('Reference', 'panna-wild-tour'); ?>:</strong> <?php echo esc_html($reference ?: __('Not submitted', 'panna-wild-tour')); ?></p>
		<?php if ($paymentUrl) : ?>
			<p><a class="button button-secondary" href="<?php echo esc_url($paymentUrl); ?>" target="_blank" rel="noopener noreferrer"><?php esc_html_e('Open Payment Page', 'panna-wild-tour'); ?></a></p>
		<?php endif; ?>
		<?php
	}

	public function saveMetaBox(int $postId): void
	{
		if (!isset($_POST['pwt_booking_payment_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['pwt_booking_payment_nonce'])), 'pwt_booking_payment_meta')) {
			return;
		}

		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
			return;
		}

		if (!current_user_can('edit_post', $postId)) {
			return;
		}

		$status = sanitize_text_field($_POST['pwt_payment_status'] ?? 'pending_payment');
		$current = (string) get_post_meta($postId, '_pwt_payment_status', true);

		if (!\PWT\Payments\PaymentManager::canTransitionStatus($current, $status)) {
			return;
		}

		update_post_meta($postId, '_pwt_payment_status', $status);
	}
}
