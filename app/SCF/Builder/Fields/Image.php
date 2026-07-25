<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Image upload/select field. */
class Image extends Field
{
    protected string $returnFormat = 'array';
    protected string $previewSize = 'medium';
    protected string $library = 'all';
    protected $minWidth = '';
    protected $maxWidth = '';
    protected $minHeight = '';
    protected $maxHeight = '';
    protected $minSize = '';
    protected $maxSize = '';
    protected string $mimeTypes = '';

    /** Return format: 'array' | 'url' | 'id' */
    public function returnFormat(string $format): static
    {
        $this->returnFormat = $format;
        return $this;
    }

    public function previewSize(string $size): static
    {
        $this->previewSize = $size;
        return $this;
    }

    /** Library: 'all' | 'uploadedTo' */
    public function library(string $library): static
    {
        $this->library = $library;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'          => 'image',
            'return_format' => $this->returnFormat,
            'preview_size'  => $this->previewSize,
            'library'       => $this->library,
            'min_width'     => $this->minWidth,
            'max_width'     => $this->maxWidth,
            'min_height'    => $this->minHeight,
            'max_height'    => $this->maxHeight,
            'min_size'      => $this->minSize,
            'max_size'      => $this->maxSize,
            'mime_types'    => $this->mimeTypes,
        ]);
    }
}
