<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** True/False (toggle) field. */
class TrueFalse extends Field
{
    protected string $message = '';
    protected bool $ui = false;
    protected string $uiOnText = '';
    protected string $uiOffText = '';

    /** Message shown alongside the toggle. */
    public function message(string $message): static
    {
        $this->message = $message;
        return $this;
    }

    /** Enable stylised toggle UI. */
    public function ui(bool $ui = true): static
    {
        $this->ui = $ui;
        return $this;
    }

    /** Label shown on the ON state. */
    public function uiOnText(string $text): static
    {
        $this->uiOnText = $text;
        return $this;
    }

    /** Label shown on the OFF state. */
    public function uiOffText(string $text): static
    {
        $this->uiOffText = $text;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'         => 'true_false',
            'message'      => $this->message,
            'ui'           => $this->ui ? 1 : 0,
            'ui_on_text'   => $this->uiOnText,
            'ui_off_text'  => $this->uiOffText,
        ]);
    }
}
