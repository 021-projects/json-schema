<?php

namespace O21\JsonSchema\Concerns;

use O21\JsonSchema\Enums\Format;
use O21\JsonSchema\Enums\Type;

trait StringTypeSchema
{
    protected ?int $_minLength = null;
    protected ?int $_maxLength = null;
    protected ?Format $_format = null;
    protected ?string $_pattern = null;

    public function stringObject(): \stdClass
    {
        $obj = $this->defaultObject();
        if ($this->_minLength !== null) {
            $obj->minLength = $this->_minLength;
        }
        if ($this->_maxLength !== null) {
            $obj->maxLength = $this->_maxLength;
        }
        if ($this->_format !== null) {
            $obj->format = $this->_format->value;
        }
        if ($this->_pattern !== null) {
            $obj->pattern = $this->_pattern;
        }
        return $obj;
    }

    public function minLength(int $value): self
    {
        $this->assertType(Type::STRING);
        $this->_minLength = $value;
        return $this;
    }

    public function maxLength(int $value): self
    {
        $this->assertType(Type::STRING);
        $this->_maxLength = $value;
        return $this;
    }

    public function format(Format $value): self
    {
        $this->assertType(Type::STRING);
        $this->_format = $value;
        return $this;
    }

    public function pattern(string $value): self
    {
        $this->assertType(Type::STRING);
        $this->_pattern = $value;
        return $this;
    }
}
