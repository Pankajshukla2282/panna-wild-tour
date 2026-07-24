<?php

namespace PWT\Admin\Settings;

defined('ABSPATH') || exit;

class Section
{
    private string $id;
    private string $title;

    private array $fields = [];

    public function __construct(
        string $id,
        string $title
    ) {
        $this->id = $id;
        $this->title = $title;
    }

    public function addField(Field $field): void
    {
        $this->fields[] = $field;
    }

    public function register(string $page): void
    {
        add_settings_section(
            $this->id,
            $this->title,
            '__return_false',
            $page
        );

        foreach ($this->fields as $field) {
            $field->register(
                $page,
                $this->id
            );
        }
    }
}