<?php

namespace O21\JsonSchema\Concerns;

use O21\JsonSchema\Schema;

trait StdBuilding
{
    protected function arrayToObject(array $array): \stdClass
    {
        $obj = new \stdClass();
        foreach ($array as $key => $value) {
            $obj->{$key} = is_a($value, Schema::class)
                ? $value->toObject()
                : $value;
        }
        return $obj;
    }

    protected function applyArrayProps(\stdClass $object, array $props): void
    {
        foreach ($props as $key => $value) {
            $object->{$key} = $value;
        }
    }

    protected function mapToObject(array $array): array
    {
        return array_map(static fn($value) => $value->toObject(), $array);
    }

    protected function filterArray(array $array): array
    {
        return array_filter($array, static fn($value) => ! empty($value));
    }
}
