<?php

declare(strict_types=1);

namespace PWT\SCF\Builder;

defined('ABSPATH') || exit;

/**
 * Base Field Builder
 *
 * Every SCF/ACF field extends this class.
 *
 * @package PWT\SCF\Builder
 */
abstract class Field
{
    /**
     * Field configuration.
     *
     * @var array<string,mixed>
     */
    protected array $config = [];

    /**
     * Constructor.
     *
     * @param string      $type
     * @param string      $name
     * @param string|null $label
     */
    public function __construct(
        string $nameOrType,
        ?string $nameOrLabel = null,
        ?string $label = null
    ) {
        $type = $this->guessType();
        $name = $nameOrType;
        $finalLabel = $nameOrLabel;

        // Backward compatibility: allow (type, name, label) constructor calls.
        if ($label !== null || $this->looksLikeType($nameOrType)) {
            $type = $nameOrType;
            $name = (string) $nameOrLabel;
            $finalLabel = $label;
        }

        $this->config = [

            'key' => static::generateKey($name),

            'label' => $finalLabel ?? static::labelize($name),

            'name' => $name,

            'type' => $type,

            'instructions' => '',

            'required' => 0,

            'conditional_logic' => 0,

            'wrapper' => [

                'width' => '',

                'class' => '',

                'id' => ''

            ]

        ];
    }

    protected function baseConfig(): array
    {
        return $this->config;
    }

    private function guessType(): string
    {
        $shortName = (new \ReflectionClass($this))->getShortName();
        $type = strtolower($shortName);

        if ($type === 'datetime') {
            return 'date_time_picker';
        }

        return $type;
    }

    private function looksLikeType(string $value): bool
    {
        $knownTypes = [
            'text',
            'textarea',
            'number',
            'email',
            'select',
            'checkbox',
            'radio',
            'true_false',
            'image',
            'gallery',
            'file',
            'link',
            'color_picker',
            'range',
            'date_picker',
            'time_picker',
            'date_time_picker',
            'wysiwyg',
            'relationship',
            'taxonomy',
            'post_object',
            'user',
            'google_map',
            'message',
            'repeater',
            'tab',
            'accordion',
            'url'
        ];

        return in_array($value, $knownTypes, true);
    }

    /**
     * Generate deterministic field key.
     *
     * @param string $name
     * @return string
     */
    protected static function generateKey(
        string $name
    ): string {

        return 'field_pwt_' . sanitize_key($name);

    }

    /**
     * Convert field name into label.
     *
     * safari_price
     *
     * =>
     *
     * Safari Price
     *
     * @param string $text
     * @return string
     */
    protected static function labelize(
        string $text
    ): string {

        return ucwords(
            str_replace(
                '_',
                ' ',
                $text
            )
        );

    }

    /**
     * Field label.
     *
     * @param string $label
     * @return static
     */
    public function label(
        string $label
    ): static {

        $this->config['label'] = $label;

        return $this;

    }

    /**
     * Field instructions.
     *
     * @param string $text
     * @return static
     */
    public function instructions(
        string $text
    ): static {

        $this->config['instructions'] = $text;

        return $this;

    }

    /**
     * Required field.
     *
     * @param bool $required
     * @return static
     */
    public function required(
        bool $required = true
    ): static {

        $this->config['required'] = $required ? 1 : 0;

        return $this;

    }

    /**
     * Default value.
     *
     * @param mixed $value
     * @return static
     */
    public function default(
        mixed $value
    ): static {

        $this->config['default_value'] = $value;

        return $this;

    }

    /**
     * Placeholder.
     *
     * @param string $placeholder
     * @return static
     */
    public function placeholder(
        string $placeholder
    ): static {

        $this->config['placeholder'] = $placeholder;

        return $this;

    }

    /**
     * Prefix.
     *
     * ₹
     *
     * @param string $prefix
     * @return static
     */
    public function prefix(
        string $prefix
    ): static {

        $this->config['prepend'] = $prefix;

        return $this;

    }

    /**
     * Suffix.
     *
     * KM
     *
     * @param string $suffix
     * @return static
     */
    public function suffix(
        string $suffix
    ): static {

        $this->config['append'] = $suffix;

        return $this;

    }

    /**
     * Wrapper width.
     *
     * @param int $width
     * @return static
     */
    public function width(
        int $width
    ): static {

        $this->config['wrapper']['width'] = max(
            0,
            min(
                100,
                $width
            )
        );

        return $this;

    }

    /**
     * CSS Class.
     *
     * @param string $class
     * @return static
     */
    public function cssClass(
        string $class
    ): static {

        $this->config['wrapper']['class'] = $class;

        return $this;

    }

    /**
     * HTML ID.
     *
     * @param string $id
     * @return static
     */
    public function id(
        string $id
    ): static {

        $this->config['wrapper']['id'] = $id;

        return $this;

    }

        /**
     * Readonly field.
     *
     * @param bool $readonly
     * @return static
     */
    public function readonly(
        bool $readonly = true
    ): static {

        $this->config['readonly'] = $readonly ? 1 : 0;

        return $this;

    }

    /**
     * Disabled field.
     *
     * @param bool $disabled
     * @return static
     */
    public function disabled(
        bool $disabled = true
    ): static {

        $this->config['disabled'] = $disabled ? 1 : 0;

        return $this;

    }

    /**
     * Maximum length.
     *
     * @param int $length
     * @return static
     */
    public function maxlength(
        int $length
    ): static {

        $this->config['maxlength'] = $length;

        return $this;

    }

    /**
     * Minimum value.
     *
     * @param int|float $value
     * @return static
     */
    public function min(
        int|float $value
    ): static {

        $this->config['min'] = $value;

        return $this;

    }

    /**
     * Maximum value.
     *
     * @param int|float $value
     * @return static
     */
    public function max(
        int|float $value
    ): static {

        $this->config['max'] = $value;

        return $this;

    }

    /**
     * Step.
     *
     * @param int|float $step
     * @return static
     */
    public function step(
        int|float $step
    ): static {

        $this->config['step'] = $step;

        return $this;

    }

    /**
     * Number of rows.
     *
     * Useful for textarea / wysiwyg.
     *
     * @param int $rows
     * @return static
     */
    public function rows(
        int $rows
    ): static {

        $this->config['rows'] = $rows;

        return $this;

    }

    /**
     * Allow null.
     *
     * @param bool $allow
     * @return static
     */
    public function allowNull(
        bool $allow = true
    ): static {

        $this->config['allow_null'] = $allow ? 1 : 0;

        return $this;

    }

    /**
     * Return format.
     *
     * @param string $format
     * @return static
     */
    public function returnFormat(
        string $format
    ): static {

        $this->config['return_format'] = $format;

        return $this;

    }

    /**
     * Conditional logic.
     *
     * @param callable $callback
     * @return static
     */
    public function conditional(
        callable $callback
    ): static {

        $conditional = new Conditional();

        $callback($conditional);

        $this->config['conditional_logic']
            = $conditional->build();

        return $this;

    }

    /**
     * Validation rules.
     *
     * @param callable $callback
     * @return static
     */
    public function validation(
        callable $callback
    ): static {

        $validation = new Validation();

        $callback($validation);

        $this->config = array_merge(
            $this->config,
            $validation->build()
        );

        return $this;

    }

    /**
     * Add arbitrary configuration.
     *
     * @param string $key
     * @param mixed $value
     * @return static
     */
    public function attribute(
        string $key,
        mixed $value
    ): static {

        $this->config[$key] = $value;

        return $this;

    }

    /**
     * Merge additional configuration.
     *
     * @param array<string,mixed> $config
     * @return static
     */
    public function merge(
        array $config
    ): static {

        $this->config = array_replace_recursive(
            $this->config,
            $config
        );

        return $this;

    }

    /**
     * Field key.
     *
     * @return string
     */
    public function key(): string
    {
        return $this->config['key'];
    }

    /**
     * Field name.
     *
     * @return string
     */
    public function name(): string
    {
        return $this->config['name'];
    }

    /**
     * Field label.
     *
     * @return string
     */
    public function getLabel(): string
    {
        return $this->config['label'];
    }

    /**
     * Field type.
     *
     * @return string
     */
    public function type(): string
    {
        return $this->config['type'];
    }

        /**
     * Assign a deterministic key using a group prefix.
     *
     * Example:
     * field_pwt_package_price
     *
     * @param string $prefix
     * @return static
     */
    public function groupPrefix(
        string $prefix
    ): static {

        $this->config['key'] = sprintf(
            'field_%s_%s',
            sanitize_key($prefix),
            sanitize_key($this->config['name'])
        );

        return $this;

    }

    /**
     * Get configuration array.
     *
     * @return array<string,mixed>
     */
    public function build(): array
    {
        return $this->config;
    }

    /**
     * Alias of build().
     *
     * @return array<string,mixed>
     */
    public function toArray(): array
    {
        return $this->build();
    }

    /**
     * Magic getter.
     *
     * @param string $property
     * @return mixed
     */
    public function __get(
        string $property
    ): mixed {

        return $this->config[$property] ?? null;

    }

    /**
     * Magic isset.
     *
     * @param string $property
     * @return bool
     */
    public function __isset(
        string $property
    ): bool {

        return isset($this->config[$property]);

    }

    /**
     * Export configuration as JSON.
     *
     * @param int $flags
     * @return string
     */
    public function toJson(
        int $flags = JSON_PRETTY_PRINT
    ): string {

        return wp_json_encode(
            $this->config,
            $flags
        );

    }

    /**
     * Magic string conversion.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->toJson();
    }

    /**
     * Clone support.
     */
    public function __clone()
    {
        $this->config = array_replace_recursive(
            [],
            $this->config
        );
    }

}