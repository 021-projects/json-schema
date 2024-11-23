<?php

namespace O21\JsonSchema\Concerns;

trait Transformation
{
    protected $_transform = null;

    /**
     * Apply transformation to the Schema when calling toObject
     *
     * @param  callable  $transform
     * @return \O21\JsonSchema\Concerns\Transformation|\O21\JsonSchema\Schema
     */
    public function transform(callable $transform): self
    {
        $this->_transform = $transform;
        return $this;
    }

    protected function applyTransform(\stdClass $obj): void
    {
        if ($this->_transform === null) {
            return;
        }

        call_user_func($this->_transform, $obj);
    }
}
