<?php

defined('ABSPATH') || exit;
?>

<div class="wrap">

<h1>Panna Wild Tour</h1>

<div class="notice notice-success">

<p>

Plugin Installed Successfully.

</p>

</div>

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

</table>

</div>