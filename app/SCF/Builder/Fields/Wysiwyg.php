<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** WYSIWYG editor field. */
class Wysiwyg extends Field
{
    protected string $tabs = 'all';
    protected string $toolbar = 'full';
    protected bool $mediaUpload = true;
    protected int $delay = 0;

    /** Show tabs: 'all' | 'visual' | 'text' */
    public function tabs(string $tabs): static
    {
        $this->tabs = $tabs;
        return $this;
    }

    /** Toolbar: 'full' | 'basic' */
    public function toolbar(string $toolbar): static
    {
        $this->toolbar = $toolbar;
        return $this;
    }

    /** Allow media upload button. */
    public function mediaUpload(bool $allow = true): static
    {
        $this->mediaUpload = $allow;
        return $this;
    }

    /** Delay initialisation (ms). */
    public function delay(int $ms): static
    {
        $this->delay = $ms;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'         => 'wysiwyg',
            'tabs'         => $this->tabs,
            'toolbar'      => $this->toolbar,
            'media_upload' => $this->mediaUpload ? 1 : 0,
            'delay'        => $this->delay,
        ]);
    }
}
