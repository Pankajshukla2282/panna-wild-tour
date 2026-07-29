<?php

declare(strict_types=1);

namespace PWT\PostTypes;

defined('ABSPATH') || exit;

/**
 * Base class for all plugin custom post types.
 */
abstract class PostType implements PostTypeInterface
{
    /**
     * Post type slug.
     */
    protected string $postType = '';

    /**
     * Singular label.
     */
    protected string $singular = '';

    /**
     * Plural label.
     */
    protected string $plural = '';

    /**
     * Supported editor features.
     *
     * @var string[]
     */
    protected array $supports = [
        'title',
        'editor',
        'thumbnail',
        'excerpt',
    ];

    /**
     * Taxonomies attached to this post type.
     *
     * @var string[]
     */
    protected array $taxonomies = [];

    /**
     * Menu icon.
     */
    protected string $menuIcon = 'dashicons-admin-post';

    /**
     * Menu position.
     */
    protected int $menuPosition = 20;

    /**
     * Whether the post type is public.
     */
    protected bool $public = true;

    /**
     * Whether REST API is enabled.
     */
    protected bool $showInRest = true;

    /**
     * Whether archives are enabled.
     */
    protected bool $hasArchive = true;

    /**
     * Rewrite slug.
     */
    protected ?string $rewriteSlug = null;

    /**
     * Capability type.
     */
    protected string $capabilityType = 'post';

    /**
     * Register the post type.
     */
    public function register(): void
    {
        add_action('init', [$this, 'create']);
    }

    /**
     * Create the post type.
     */
    final public function create(): void
    {
        $this->validate();

        register_post_type(
            $this->postType,
            apply_filters(
                "pwt/post_type_args/{$this->postType}",
                $this->args()
            )
        );
    }

    /**
     * Validate required configuration.
     */
    protected function validate(): void
    {
        if (
            $this->postType === ''
            || $this->singular === ''
            || $this->plural === ''
        ) {
            _doing_it_wrong(
                static::class,
                __('Post type configuration is incomplete.', 'panna-wild-tour'),
                PWT_VERSION
            );
        }
    }

    /**
     * Build post type arguments.
     */
    protected function args(): array
    {
        return [
            'labels'          => $this->labels(),
            'public'          => $this->public,
            'show_in_rest'    => $this->showInRest,
            'menu_position'   => $this->menuPosition,
            'menu_icon'       => $this->menuIcon,
            'supports'        => apply_filters(
                "pwt/post_type_supports/{$this->postType}",
                $this->supports
            ),
            'taxonomies'      => $this->taxonomies,
            'has_archive'     => $this->hasArchive,
            'capability_type' => $this->capabilityType,
            'rewrite'         => [
                'slug' => $this->rewriteSlug ?? $this->postType,
            ],
        ];
    }

    /**
     * Build labels.
     */
    protected function labels(): array
    {
        return apply_filters(
            "pwt/post_type_labels/{$this->postType}",
            [
                'name'               => $this->plural,
                'singular_name'      => $this->singular,
                'add_new'            => __('Add New', 'panna-wild-tour'),
                'add_new_item'       => sprintf(__('Add New %s', 'panna-wild-tour'), $this->singular),
                'edit_item'          => sprintf(__('Edit %s', 'panna-wild-tour'), $this->singular),
                'new_item'           => sprintf(__('New %s', 'panna-wild-tour'), $this->singular),
                'view_item'          => sprintf(__('View %s', 'panna-wild-tour'), $this->singular),
                'search_items'       => sprintf(__('Search %s', 'panna-wild-tour'), $this->plural),
                'not_found'          => sprintf(__('No %s found.', 'panna-wild-tour'), strtolower($this->plural)),
                'not_found_in_trash' => sprintf(__('No %s found in Trash.', 'panna-wild-tour'), strtolower($this->plural)),
                'all_items'          => sprintf(__('All %s', 'panna-wild-tour'), $this->plural),
            ]
        );
    }
}