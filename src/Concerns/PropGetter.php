<?php

namespace O21\JsonSchema\Concerns;

trait PropGetter
{
    public function getProp(string $prop): mixed
    {
        if (property_exists($this, $prop)) {
            return $this->$prop;
        }
        if (! str_starts_with($prop, '_')) {
            return $this->getProp('_'.$prop);
        }
        return null;
    }
}
