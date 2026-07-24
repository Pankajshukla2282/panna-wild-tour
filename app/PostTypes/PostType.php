<?php

namespace PWT\PostTypes;

defined('ABSPATH') || exit;

abstract class PostType
{
    protected string $postType;
    protected string $singular;
    protected string $plural;

    protected array $supports = [
        'title',
        'editor',
        'thumbnail',
        'excerpt'
    ];

    public function register(): void
    {
        add_action('init', [$this, 'create']);
    }

    public function create(): void
    {
        register_post_type(
            $this->postType,
            $this->args()
        );
    }

    protected function args(): array
    {
        return [
            'labels' => $this->labels(),

            'public' => true,

            'show_in_rest' => true,

            'menu_position' => 20,

            'menu_icon' => $this->menuIcon(),

            'supports' => $this->supports,

            'has_archive' => true,

            'rewrite' => [
                'slug' => $this->postType
            ]
        ];
    }

    protected function labels(): array
    {
        return [

            'name' => $this->plural,

            'singular_name' => $this->singular,

            'add_new' => __('Add New','panna-wild-tour'),

            'add_new_item' =>
                sprintf(
                    __('Add New %s','panna-wild-tour'),
                    $this->singular
                ),

            'edit_item' =>
                sprintf(
                    __('Edit %s','panna-wild-tour'),
                    $this->singular
                ),

            'new_item' =>
                sprintf(
                    __('New %s','panna-wild-tour'),
                    $this->singular
                ),

            'view_item' =>
                sprintf(
                    __('View %s','panna-wild-tour'),
                    $this->singular
                ),

            'search_items' =>
                sprintf(
                    __('Search %s','panna-wild-tour'),
                    $this->plural
                )

        ];
    }

    protected function menuIcon(): string
    {
        return 'dashicons-admin-post';
    }
}