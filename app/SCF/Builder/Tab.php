<?php

namespace PWT\SCF\Builder;

defined('ABSPATH') || exit;

/**
 * Represents a Tab separator field in a field group.
 */
class Tab extends Field
{
    /** @var string Tab placement: 'top' | 'left' */
    protected string $placement = 'top';

    /** @var bool Wrap the tab in a wrapper element */
    protected bool $endpoint = false;

    /** Set tab placement ('top' or 'left'). */
    public function placement(string $placement): static
    {
        $this->placement = $placement;
        return $this;
    }

    /** Mark this tab as an endpoint (closes the tab). */
    public function endpoint(bool $endpoint = true): static
    {
        $this->endpoint = $endpoint;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'      => 'tab',
            'placement' => $this->placement,
            'endpoint'  => $this->endpoint ? 1 : 0,
        ]);
    }
}
