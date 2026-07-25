<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Message (read-only notice) field. */
class Message extends Field
{
    protected string $messageText = '';
    protected string $newLines = 'wpautop';
    protected bool $esc = true;

    /** The message body (supports HTML). */
    public function message(string $text): static
    {
        $this->messageText = $text;
        return $this;
    }

    /** New-line handling: 'wpautop' | 'br' | '' */
    public function newLines(string $mode): static
    {
        $this->newLines = $mode;
        return $this;
    }

    /** Whether to escape HTML. */
    public function esc(bool $esc = true): static
    {
        $this->esc = $esc;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'      => 'message',
            'message'   => $this->messageText,
            'new_lines' => $this->newLines,
            'esc_html'  => $this->esc ? 1 : 0,
        ]);
    }
}
