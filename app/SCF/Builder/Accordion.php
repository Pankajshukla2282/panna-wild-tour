<?php

namespace PWT\SCF\Builder;

defined('ABSPATH') || exit;

/**
 * Represents an Accordion field in a field group.
 */
class Accordion extends Field
{
    /** @var bool Open the first accordion by default */
    protected bool $openFirst = false;

    /** @var bool Keep accordion open (no toggle) */
    protected bool $openState = false;

    /** @var bool Mark as an endpoint (closes the accordion) */
    protected bool $endpoint = false;

    /** Whether the first accordion item should be open on load. */
    public function openFirst(bool $open = true): static
    {
        $this->openFirst = $open;
        return $this;
    }

    /** Keep the accordion always open. */
    public function openState(bool $open = true): static
    {
        $this->openState = $open;
        return $this;
    }

    /** Mark as an endpoint (closes the accordion group). */
    public function endpoint(bool $endpoint = true): static
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'       => 'accordion',
            'open'       => $this->openFirst ? 1 : 0,
            'multi_expand' => $this->openState ? 1 : 0,
            'endpoint'   => $this->endpoint ? 1 : 0,
        ]);
    }
}
