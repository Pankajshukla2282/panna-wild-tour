<?php

namespace PWT\Taxonomies;

defined('ABSPATH') || exit;

abstract class Taxonomy
{
    protected string $taxonomy;

    protected array $postTypes = [];

    protected string $singular;

    protected string $plural;

    protected bool $hierarchical = true;

    public function register(): void
    {
        add_action('init', [$this, 'create']);
    }

    public function create(): void
    {
        register_taxonomy(
            $this->taxonomy,
            $this->postTypes,
            $this->args()
        );
    }

    protected function args(): array
    {
        return [

            'labels' => $this->labels(),

            'public' => true,

            'hierarchical' => $this->hierarchical,

            'show_admin_column' => true,

            'show_in_rest' => true,

            'rewrite' => [
                'slug' => $this->taxonomy
            ]

        ];
    }

    protected function labels(): array
    {
        return [

            'name' => __($this->plural, 'panna-wild-tour'),

            'singular_name' => __($this->singular, 'panna-wild-tour'),

            'search_items' => sprintf(
                __('Search %s', 'panna-wild-tour'),
                $this->plural
            ),

            'all_items' => sprintf(
                __('All %s', 'panna-wild-tour'),
                $this->plural
            ),

            'edit_item' => sprintf(
                __('Edit %s', 'panna-wild-tour'),
                $this->singular
            ),

            'add_new_item' => sprintf(
                __('Add New %s', 'panna-wild-tour'),
                $this->singular
            )

        ];
    }
}