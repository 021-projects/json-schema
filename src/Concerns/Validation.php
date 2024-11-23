<?php

namespace O21\JsonSchema\Concerns;

use O21\JsonSchema\Enums\Type;

trait Validation
{
    protected function assertArrayItemsInstanceOf(array $items, string $class): void
    {
        foreach ($items as $item) {
            if (! is_a($item, $class)) {
                throw new \InvalidArgumentException(
                    'Items must be an instance of '.$class
                );
            }
        }
    }

    protected function assertType(Type ...$type): void
    {
        if (! in_array($this->type, $type, true)) {
            $types = array_map(static fn($t) => $t->value, $type);
            throw new \InvalidArgumentException(
                'This method can be called only for ' . implode(', ', $types) . ' type'
            );
        }
    }
}
