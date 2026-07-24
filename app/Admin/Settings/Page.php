<?php

namespace PWT\Admin\Settings;

defined('ABSPATH') || exit;

class Page
{
    protected string $optionGroup;
    protected string $optionName;
    protected string $pageSlug;

    protected array $sections = [];

    public function __construct(
        string $group,
        string $option,
        string $slug
    ) {
        $this->optionGroup = $group;
        $this->optionName = $option;
        $this->pageSlug = $slug;
    }

    public function addSection(Section $section): void
    {
        $this->sections[] = $section;
    }

    public function register(): void
    {
        register_setting(
            $this->optionGroup,
            $this->optionName,
            [Sanitizer::class, 'sanitize']
        );

        foreach ($this->sections as $section) {
            $section->register($this->pageSlug);
        }
    }
}