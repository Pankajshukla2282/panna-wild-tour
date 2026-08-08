<?php

defined('ABSPATH') || exit;

$postTypes = [
	'pwt_package' => __('Packages', 'wildtours-plugin'),
	'pwt_safari' => __('Safaris', 'wildtours-plugin'),
	'pwt_destination' => __('Destinations', 'wildtours-plugin'),
	'pwt_booking' => __('Bookings', 'wildtours-plugin'),
	'pwt_review' => __('Reviews', 'wildtours-plugin'),
];

$counts = [];
foreach ($postTypes as $postType => $label) {
	$obj = wp_count_posts($postType);
	$counts[$postType] = (int) ($obj->publish ?? 0);
}

$bookingCount = (int) get_option('pwt_analytics_booking_count', 0);

$bookingIds = get_posts([
	'post_type' => 'pwt_booking',
	'post_status' => 'publish',
	'posts_per_page' => -1,
	'fields' => 'ids',
]);

$statusCounts = [
	'pending_payment' => 0,
	'verification_pending' => 0,
	'partial_paid' => 0,
	'paid' => 0,
	'failed' => 0,
	'cancelled' => 0,
];

$popularPackageCounts = [];

foreach ($bookingIds as $bookingId) {
	$status = (string) get_post_meta((int) $bookingId, '_pwt_payment_status', true);
	if ($status !== '' && isset($statusCounts[$status])) {
		$statusCounts[$status]++;
	}

	$packageId = (int) get_post_meta((int) $bookingId, '_pwt_package_id', true);
	if ($packageId > 0) {
		if (!isset($popularPackageCounts[$packageId])) {
			$popularPackageCounts[$packageId] = 0;
		}
		$popularPackageCounts[$packageId]++;
	}
}

arsort($popularPackageCounts);
$topPackages = array_slice($popularPackageCounts, 0, 5, true);

$confirmedBookings = $statusCounts['partial_paid'] + $statusCounts['paid'];
$totalBookings = count($bookingIds);
$conversionRate = $totalBookings > 0 ? round(($confirmedBookings / $totalBookings) * 100, 2) : 0.0;
?>

<div class="wrap">

<h1>Panna Wild Tour</h1>

<table class="widefat striped">

<tr>

<th>Version</th>

<td><?php echo esc_html(PWT_VERSION); ?></td>

</tr>

<tr>

<th>PHP</th>

<td><?php echo esc_html(PHP_VERSION); ?></td>

</tr>

<tr>

<th>WordPress</th>

<td><?php echo esc_html(get_bloginfo('version')); ?></td>

</tr>

<tr>

<th>Total Tracked Bookings</th>

<td><?php echo esc_html((string) $bookingCount); ?></td>

</tr>

<tr>

<th>Total Booking Records</th>

<td><?php echo esc_html((string) $totalBookings); ?></td>

</tr>

<tr>

<th>Confirmed Bookings</th>

<td><?php echo esc_html((string) $confirmedBookings); ?></td>

</tr>

<tr>

<th>Conversion Rate</th>

<td><?php echo esc_html(number_format_i18n($conversionRate, 2) . '%'); ?></td>

</tr>

</table>

<h2><?php esc_html_e('Content Inventory', 'wildtours-plugin'); ?></h2>

<table class="widefat striped">
	<thead>
		<tr>
			<th><?php esc_html_e('Module', 'wildtours-plugin'); ?></th>
			<th><?php esc_html_e('Published Count', 'wildtours-plugin'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($postTypes as $postType => $label) : ?>
			<tr>
				<td><?php echo esc_html($label); ?></td>
				<td><?php echo esc_html((string) $counts[$postType]); ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<h2><?php esc_html_e('Payment Funnel', 'wildtours-plugin'); ?></h2>

<table class="widefat striped">
	<thead>
		<tr>
			<th><?php esc_html_e('Status', 'wildtours-plugin'); ?></th>
			<th><?php esc_html_e('Count', 'wildtours-plugin'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($statusCounts as $status => $count) : ?>
			<tr>
				<td><?php echo esc_html(\PWT\Payments\PaymentManager::statusLabel((string) $status)); ?></td>
				<td><?php echo esc_html((string) $count); ?></td>
			</tr>
		<?php endforeach; ?>
	</tbody>
</table>

<h2><?php esc_html_e('Popular Packages by Bookings', 'wildtours-plugin'); ?></h2>

<table class="widefat striped">
	<thead>
		<tr>
			<th><?php esc_html_e('Package', 'wildtours-plugin'); ?></th>
			<th><?php esc_html_e('Bookings', 'wildtours-plugin'); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($topPackages)) : ?>
			<?php foreach ($topPackages as $packageId => $count) : ?>
				<tr>
					<td><?php echo esc_html(get_the_title((int) $packageId) ?: __('(untitled)', 'wildtours-plugin')); ?></td>
					<td><?php echo esc_html((string) $count); ?></td>
				</tr>
			<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td colspan="2"><?php esc_html_e('No booking data available yet.', 'wildtours-plugin'); ?></td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>

</div>