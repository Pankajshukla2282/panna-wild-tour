<?php

namespace PWT\Payments;

defined('ABSPATH') || exit;

class PaymentManager
{
    public function register(): void
    {
        add_action('init', [$this, 'handlePortalSubmission']);
    }

    public static function createIntent(int $bookingId, float $estimatedTotal): array
    {
        $settings = get_option('pwt_settings', []);
        $advancePercent = max(1, min(100, (int) ($settings['payment_advance_percent'] ?? 30)));
        $advanceAmount = round(($estimatedTotal * $advancePercent) / 100, 2);
        $token = wp_generate_password(24, false, false);

        update_post_meta($bookingId, '_pwt_payment_token', $token);
        update_post_meta($bookingId, '_pwt_payment_status', 'pending_payment');
        update_post_meta($bookingId, '_pwt_payment_advance_percent', $advancePercent);
        update_post_meta($bookingId, '_pwt_payment_due_amount', $advanceAmount);
        update_post_meta($bookingId, '_pwt_payment_total_amount', $estimatedTotal);

        return [
            'token' => $token,
            'advance_amount' => $advanceAmount,
            'payment_url' => self::paymentUrl($token),
        ];
    }

    public static function paymentUrl(string $token): string
    {
        $settings = get_option('pwt_settings', []);
        $baseUrl = trim((string) ($settings['payment_page_url'] ?? ''));

        if ($baseUrl === '') {
            return '';
        }

        return add_query_arg('pwt_payment', rawurlencode($token), $baseUrl);
    }

    public static function getBookingByToken(string $token): int
    {
        $posts = get_posts([
            'post_type' => 'pwt_booking',
            'post_status' => 'publish',
            'posts_per_page' => 1,
            'fields' => 'ids',
            'meta_query' => [[
                'key' => '_pwt_payment_token',
                'value' => $token,
            ]],
        ]);

        return (int) ($posts[0] ?? 0);
    }

    public static function portalContext(string $token): array
    {
        $bookingId = self::getBookingByToken($token);

        if (!$bookingId) {
            return [];
        }

        $settings = get_option('pwt_settings', []);

        return [
            'booking_id' => $bookingId,
            'name' => (string) get_post_meta($bookingId, '_pwt_name', true),
            'phone' => (string) get_post_meta($bookingId, '_pwt_phone', true),
            'package_name' => get_the_title((int) get_post_meta($bookingId, '_pwt_package_id', true)),
            'travel_date' => (string) get_post_meta($bookingId, '_pwt_travel_date', true),
            'status' => (string) get_post_meta($bookingId, '_pwt_payment_status', true),
            'advance_amount' => (float) get_post_meta($bookingId, '_pwt_payment_due_amount', true),
            'total_amount' => (float) get_post_meta($bookingId, '_pwt_payment_total_amount', true),
            'payment_reference' => (string) get_post_meta($bookingId, '_pwt_payment_reference', true),
            'payment_method' => (string) get_post_meta($bookingId, '_pwt_payment_method', true),
            'upi_id' => (string) ($settings['payment_upi_id'] ?? ''),
            'instructions' => (string) ($settings['payment_instructions'] ?? ''),
        ];
    }

    public function handlePortalSubmission(): void
    {
        if (($_POST['action'] ?? '') !== 'pwt_submit_payment_reference') {
            return;
        }

        $token = sanitize_text_field($_POST['payment_token'] ?? '');
        $bookingId = self::getBookingByToken($token);

        if (!$bookingId) {
            return;
        }

        check_admin_referer('pwt_payment_portal_' . $bookingId);

        $reference = sanitize_text_field($_POST['payment_reference'] ?? '');
        $method = sanitize_text_field($_POST['payment_method'] ?? 'upi');

        if ($reference === '') {
            wp_safe_redirect(add_query_arg('payment_error', '1', wp_get_referer() ?: home_url('/')));
            exit;
        }

        update_post_meta($bookingId, '_pwt_payment_reference', $reference);
        update_post_meta($bookingId, '_pwt_payment_method', $method);
        update_post_meta($bookingId, '_pwt_payment_status', 'verification_pending');
        update_post_meta($bookingId, '_pwt_payment_submitted_at', current_time('mysql'));

        wp_safe_redirect(add_query_arg('payment_success', '1', wp_get_referer() ?: home_url('/')));
        exit;
    }

    public static function statusLabel(string $status): string
    {
        $labels = [
            'pending_payment' => __('Pending Payment', 'panna-wild-tour'),
            'verification_pending' => __('Verification Pending', 'panna-wild-tour'),
            'partial_paid' => __('Advance Received', 'panna-wild-tour'),
            'paid' => __('Paid in Full', 'panna-wild-tour'),
            'failed' => __('Failed', 'panna-wild-tour'),
            'cancelled' => __('Cancelled', 'panna-wild-tour'),
        ];

        return $labels[$status] ?? __('Pending Payment', 'panna-wild-tour');
    }
}
