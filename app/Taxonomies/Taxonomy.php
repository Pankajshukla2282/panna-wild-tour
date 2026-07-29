<?php

declare(strict_types=1);

namespace PWT\Taxonomies;

defined('ABSPATH') || exit;

use PWT\Taxonomies\Contracts\TaxonomyInterface;

/**
 * Base taxonomy class.
 */
abstract class Taxonomy implements TaxonomyInterface
{
    /**
     * Taxonomy slug.
     */
    protected string $taxonomy = '';

    /**
     * Related post types.
     *
     * @var string[]
     */
    protected array $postTypes = [];

    /**
     * Singular label.
     */
    protected string $singular = '';

    /**
     * Plural label.
     */
    protected string $plural = '';

    /**
     * Hierarchical taxonomy.
     */
    protected bool $hierarchical = true;

    /**
     * Public taxonomy.
     */
    protected bool $public = true;

    /**
     * REST support.
     */
    protected bool $showInRest = true;

    /**
     * Show admin column.
     */
    protected bool $showAdminColumn = true;

    /**
     * Rewrite slug.
     */
    protected ?string $rewriteSlug = null;

    /**
     * Register taxonomy.
     */
    public function register(): void
    {
        add_action('init', [$this, 'create']);
    }

    /**
     * Register with WordPress.
     */
    final public function create(): void
    {
        $this->validate();

        register_taxonomy(
            $this->taxonomy,
            $this->postTypes,
            apply_filters(
                "pwt/taxonomy_args/{$this->taxonomy}",
                $this->args()
            )
        );
    }

    /**
     * Validate configuration.
     */
    protected function validate(): void
    {
        if (
            $this->taxonomy === '' ||
            $this->singular === '' ||
            $this->plural === '' ||
            empty($this->postTypes)
        ) {
            _doing_it_wrong(
                static::class,
                __('Taxonomy configuration is incomplete.', 'panna-wild-tour'),
                defined('PWT_VERSION') ? PWT_VERSION : '1.0.0'
            );
        }
    }

    /**
     * Taxonomy arguments.
     */
    protected function args(): array
    {
        return [
            'labels'            => $this->labels(),
            'public'            => $this->public,
            'hierarchical'      => $this->hierarchical,
            'show_admin_column' => $this->showAdminColumn,
            'show_in_rest'      => $this->showInRest,
            'rewrite'           => [
                'slug' => $this->rewriteSlug ?? $this->taxonomy,
            ],
        ];
    }

    /**
     * Taxonomy labels.
     */
    protected function labels(): array
    {
        return apply_filters(
            "pwt/taxonomy_labels/{$this->taxonomy}",
            [
                'name'              => __($this->plural, 'panna-wild-tour'),
                'singular_name'     => __($this->singular, 'panna-wild-tour'),
                'search_items'      => sprintf(__('Search %s', 'panna-wild-tour'), $this->plural),
                'all_items'         => sprintf(__('All %s', 'panna-wild-tour'), $this->plural),
                'edit_item'         => sprintf(__('Edit %s', 'panna-wild-tour'), $this->singular),
                'update_item'       => sprintf(__('Update %s', 'panna-wild-tour'), $this->singular),
                'add_new_item'      => sprintf(__('Add New %s', 'panna-wild-tour'), $this->singular),
                'new_item_name'     => sprintf(__('New %s Name', 'panna-wild-tour'), $this->singular),
                'menu_name'         => __($this->plural, 'panna-wild-tour'),
            ]
        );
    }
}