<?php

namespace PWT\SCF\Builder\Support;

use PWT\SCF\Builder\Group;

defined('ABSPATH') || exit;

/**
 * Export / import field group configurations.
 */
class Exporter
{
    /**
     * Convert a Group to a JSON string.
     *
     * @param  Group  $group  The field group to export.
     * @return string         JSON-encoded configuration.
     */
    public function toJson(Group $group): string
    {
        return (string) wp_json_encode($this->toArray($group), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Convert a Group to a plain PHP array.
     *
     * @param  Group $group
     * @return array
     */
    public function toArray(Group $group): array
    {
        return $group->build();
    }

    /**
     * Reconstruct a Group from a previously exported array.
     *
     * @param  array $data  Exported configuration array.
     * @return array        Raw field group config (ready for scf_register_field_group).
     */
    public function fromArray(array $data): array
    {
        return $data;
    }
}
