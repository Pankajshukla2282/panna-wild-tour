<?php

declare(strict_types=1);

namespace PWT\SCF\Builder;

use PWT\SCF\Builder\Fields\Checkbox;
use PWT\SCF\Builder\Fields\Color;
use PWT\SCF\Builder\Fields\Date;
use PWT\SCF\Builder\Fields\DateTime;
use PWT\SCF\Builder\Fields\Email;
use PWT\SCF\Builder\Fields\File;
use PWT\SCF\Builder\Fields\Gallery;
use PWT\SCF\Builder\Fields\GoogleMap;
use PWT\SCF\Builder\Fields\Image;
use PWT\SCF\Builder\Fields\Link;
use PWT\SCF\Builder\Fields\Message;
use PWT\SCF\Builder\Fields\Number;
use PWT\SCF\Builder\Fields\PostObject;
use PWT\SCF\Builder\Fields\Radio;
use PWT\SCF\Builder\Fields\Range;
use PWT\SCF\Builder\Fields\Relationship;
use PWT\SCF\Builder\Fields\Select;
use PWT\SCF\Builder\Fields\Taxonomy;
use PWT\SCF\Builder\Fields\Text;
use PWT\SCF\Builder\Fields\Textarea;
use PWT\SCF\Builder\Fields\Time;
use PWT\SCF\Builder\Fields\TrueFalse;
use PWT\SCF\Builder\Fields\Url;
use PWT\SCF\Builder\Fields\User;
use PWT\SCF\Builder\Fields\Wysiwyg;

defined('ABSPATH') || exit;

class Group
{
    protected array $group = [];
    protected string $prefix;

    public function __construct(string $title)
    {
        $this->prefix = sanitize_key($title);

        $this->group = [
            'key' => 'group_' . $this->prefix,
            'title' => $title,
            'fields' => [],
            'location' => [],
            'position' => 'normal',
            'style' => 'default',
            'label_placement' => 'top',
            'instruction_placement' => 'label',
            'hide_on_screen' => [],
            'active' => true,
            'description' => '',
        ];
    }

    public static function make(string $title): static
    {
        return new static($title);
    }

    public function description(string $description): static
    {
        $this->group['description'] = $description;

        return $this;
    }

    public function location(string $postType): static
    {
        $this->group['location'] = [[[
            'param' => 'post_type',
            'operator' => '=',
            'value' => $postType,
        ]]];

        return $this;
    }

    public function position(string $position): static
    {
        $this->group['position'] = $position;

        return $this;
    }

    public function style(string $style): static
    {
        $this->group['style'] = $style;

        return $this;
    }

    public function hideOnScreen(array $items): static
    {
        $this->group['hide_on_screen'] = $items;

        return $this;
    }

    public function field(Field $field, ?callable $configure = null): static
    {
        $field->groupPrefix($this->prefix);

        if ($configure) {
            $configure($field);
        }

        $this->group['fields'][] = $field->build();

        return $this;
    }

    public function text(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Text($name, $label), $configure);
    }

    public function textarea(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Textarea($name, $label), $configure);
    }

    public function number(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Number($name, $label), $configure);
    }

    public function email(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Email($name, $label), $configure);
    }

    public function select(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Select($name, $label), $configure);
    }

    public function checkbox(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Checkbox($name, $label), $configure);
    }

    public function radio(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Radio($name, $label), $configure);
    }

    public function trueFalse(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new TrueFalse($name, $label), $configure);
    }

    public function image(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Image($name, $label), $configure);
    }

    public function gallery(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Gallery($name, $label), $configure);
    }

    public function file(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new File($name, $label), $configure);
    }

    public function link(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Link($name, $label), $configure);
    }

    public function color(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Color($name, $label), $configure);
    }

    public function range(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Range($name, $label), $configure);
    }

    public function date(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Date($name, $label), $configure);
    }

    public function time(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Time($name, $label), $configure);
    }

    public function dateTime(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new DateTime($name, $label), $configure);
    }

    public function wysiwyg(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Wysiwyg($name, $label), $configure);
    }

    public function relationship(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Relationship($name, $label), $configure);
    }

    public function taxonomy(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Taxonomy($name, $label), $configure);
    }

    public function postObject(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new PostObject($name, $label), $configure);
    }

    public function user(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new User($name, $label), $configure);
    }

    public function googleMap(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new GoogleMap($name, $label), $configure);
    }

    public function message(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Message($name, $label), $configure);
    }

    public function url(string $name, ?string $label = null, ?callable $configure = null): static
    {
        return $this->field(new Url($name, $label), $configure);
    }

    public function repeater(string $name, callable $callback, ?string $label = null): static
    {
        $repeater = new Repeater($name, $label);
        $repeater->groupPrefix($this->prefix);
        $callback($repeater);

        $this->group['fields'][] = $repeater->build();

        return $this;
    }

    public function tab(string $label): static
    {
        $this->group['fields'][] = [
            'key' => 'field_' . $this->prefix . '_tab_' . sanitize_key($label),
            'label' => $label,
            'name' => '',
            'type' => 'tab',
            'placement' => 'top',
            'endpoint' => 0,
        ];

        return $this;
    }

    public function register(): void
    {
        if (function_exists('scf_register_field_group')) {
            scf_register_field_group($this->group);
            return;
        }

        if (function_exists('acf_add_local_field_group')) {
            acf_add_local_field_group($this->group);
        }
    }

    public function build(): array
    {
        return $this->group;
    }
}
