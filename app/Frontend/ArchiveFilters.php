<?php

namespace PWT\Frontend;

defined('ABSPATH') || exit;

class ArchiveFilters
{
    public function register(): void
    {
        add_action('pre_get_posts', [$this, 'applyFilters']);
    }

    public function applyFilters(\WP_Query $query): void
    {
        if (is_admin() || !$query->is_main_query()) {
            return;
        }

        $postType = $this->detectPostType($query);

        if (!$postType) {
            return;
        }

        $taxQuery = (array) $query->get('tax_query');

        if ($postType === 'pwt_package') {
            $this->maybeAddTaxFilter($taxQuery, 'pwt_package_category', sanitize_text_field($_GET['package_category'] ?? ''));
            $this->maybeAddTaxFilter($taxQuery, 'pwt_season', sanitize_text_field($_GET['season'] ?? ''));
        }

        if ($postType === 'pwt_safari') {
            $this->maybeAddTaxFilter($taxQuery, 'pwt_safari_zone', sanitize_text_field($_GET['safari_zone'] ?? ''));
            $this->maybeAddTaxFilter($taxQuery, 'pwt_season', sanitize_text_field($_GET['season'] ?? ''));
        }

        if ($postType === 'pwt_destination') {
            $this->maybeAddTaxFilter($taxQuery, 'pwt_destination_category', sanitize_text_field($_GET['destination_category'] ?? ''));
        }

        if (count($taxQuery) > 1) {
            $taxQuery['relation'] = 'AND';
        }

        $query->set('tax_query', $taxQuery);
        $query->set('posts_per_page', 12);
    }

    private function detectPostType(\WP_Query $query): string
    {
        $requestedType = sanitize_text_field($_GET['content_type'] ?? '');

        if ($query->is_tax('pwt_season') && $requestedType === '') {
            $requestedType = 'pwt_package';
            $query->set('post_type', 'pwt_package');
        }

        if (in_array($requestedType, ['pwt_package', 'pwt_safari', 'pwt_destination'], true)) {
            return $requestedType;
        }

        if ($query->is_post_type_archive('pwt_package') || $query->is_tax('pwt_package_category')) {
            return 'pwt_package';
        }

        if ($query->is_post_type_archive('pwt_safari') || $query->is_tax('pwt_safari_zone')) {
            return 'pwt_safari';
        }

        if ($query->is_post_type_archive('pwt_destination') || $query->is_tax('pwt_destination_category')) {
            return 'pwt_destination';
        }

        if ($query->is_tax('pwt_season')) {
            return '';
        }

        return '';
    }

    private function maybeAddTaxFilter(array &$taxQuery, string $taxonomy, string $termSlug): void
    {
        if (!$termSlug) {
            return;
        }

        $taxQuery[] = [
            'taxonomy' => $taxonomy,
            'field' => 'slug',
            'terms' => $termSlug,
        ];
    }
}
