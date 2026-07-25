<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** File upload/select field. */
class File extends Field
{
    protected string $returnFormat = 'array';
    protected string $library = 'all';
    protected $minSize = '';
    protected $maxSize = '';
    protected string $mimeTypes = '';

    /** Return format: 'array' | 'url' | 'id' */
    public function returnFormat(string $format): static
    {
        $this->returnFormat = $format;
        return $this;
    }

    /** Library: 'all' | 'uploadedTo' */
    public function library(string $library): static
    {
        $this->library = $library;
        return $this;
    }

    public function minSize($size): static
    {
        $this->minSize = $size;
        return $this;
    }

    public function maxSize($size): static
    {
        $this->maxSize = $size;
        return $this;
    }

    /** Comma-separated MIME types, e.g. 'image/jpeg,image/png'. */
    public function mimeTypes(string $types): static
    {
        $this->mimeTypes = $types;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'          => 'file',
            'return_format' => $this->returnFormat,
            'library'       => $this->library,
            'min_size'      => $this->minSize,
            'max_size'      => $this->maxSize,
            'mime_types'    => $this->mimeTypes,
        ]);
    }
}
