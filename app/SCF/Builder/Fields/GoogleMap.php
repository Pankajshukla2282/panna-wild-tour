<?php

namespace PWT\SCF\Builder\Fields;

use PWT\SCF\Builder\Field;

defined('ABSPATH') || exit;

/** Google Map field. */
class GoogleMap extends Field
{
    protected string $centerLat = '';
    protected string $centerLng = '';
    protected int $zoom = 14;
    protected int $height = 400;

    public function centerLat(string $lat): static
    {
        $this->centerLat = $lat;
        return $this;
    }

    public function centerLng(string $lng): static
    {
        $this->centerLng = $lng;
        return $this;
    }

    public function zoom(int $zoom): static
    {
        $this->zoom = $zoom;
        return $this;
    }

    public function height(int $pixels): static
    {
        $this->height = $pixels;
        return $this;
    }

    public function build(): array
    {
        return array_merge($this->baseConfig(), [
            'type'       => 'google_map',
            'center_lat' => $this->centerLat,
            'center_lng' => $this->centerLng,
            'zoom'       => $this->zoom,
            'height'     => $this->height,
        ]);
    }
}
