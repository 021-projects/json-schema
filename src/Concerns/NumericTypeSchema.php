<?php

namespace O21\JsonSchema\Concerns;

use O21\JsonSchema\Enums\Type;

trait NumericTypeSchema
{
    protected int|float|null $minimum = null;
    protected int|float|null $maximum = null;
    protected int|float|bool|null $exclusiveMinimum = null;
    protected int|float|bool|null $exclusiveMaximum = null;
    protected int|float|null $_multipleOf = null;

    protected function numericObject(): \stdClass
    {
        $obj = $this->defaultObject();
        $props = $this->filterArray([
            'minimum' => $this->minimum,
            'maximum' => $this->maximum,
            'exclusiveMinimum' => $this->exclusiveMinimum,
            'exclusiveMaximum' => $this->exclusiveMaximum,
            'multipleOf' => $this->_multipleOf,
        ]);
        $this->applyArrayProps($obj, $props);
        return $obj;
    }

    public function min(int|float $value): self
    {
        $this->assertType(Type::NUMBER, Type::INTEGER);
        $this->minimum = $value;
        return $this;
    }

    public function max(int|float $value): self
    {
        $this->assertType(Type::NUMBER, Type::INTEGER);
        $this->maximum = $value;
        return $this;
    }

    public function exclusiveMin(int|float $value): self
    {
        $this->assertType(Type::NUMBER, Type::INTEGER);
        $this->exclusiveMinimum = $value;
        return $this;
    }

    public function exclusiveMax(int|float $value): self
    {
        $this->assertType(Type::NUMBER, Type::INTEGER);
        $this->exclusiveMaximum = $value;
        return $this;
    }

    public function multipleOf(int|float $value): self
    {
        $this->assertType(Type::NUMBER, Type::INTEGER);
        $this->_multipleOf = $value;
        return $this;
    }

}
