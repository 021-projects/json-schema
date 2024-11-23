<?php

namespace O21\JsonSchema\Concerns;

use O21\JsonSchema\Schema;
use O21\JsonSchema\Enums\Type;

trait ArrayTypeSchema
{
    protected ?array $_prefixItems = null;
    protected Schema|bool|null $_items = null;
    protected ?Schema $_contains = null;
    protected ?int $_minContains = null;
    protected ?int $_maxContains = null;
    protected ?int $_minItems = null;
    protected ?int $_maxItems = null;
    protected ?bool $_uniqueItems = null;

    protected function arrayObject(): \stdClass
    {
        $obj = $this->defaultObject();
        if ($this->_prefixItems !== null) {
            $obj->prefixItems = $this->mapToObject($this->_prefixItems);
        }
        if ($this->_items !== null) {
            $obj->items = is_bool($this->_items)
                ? $this->_items
                : $this->_items->toObject();
        }
        if ($this->_contains !== null) {
            $obj->contains = $this->_contains->toObject();
        }
        if ($this->_minContains !== null) {
            $obj->minContains = $this->_minContains;
        }
        if ($this->_maxContains !== null) {
            $obj->maxContains = $this->_maxContains;
        }
        if ($this->_minItems !== null) {
            $obj->minItems = $this->_minItems;
        }
        if ($this->_maxItems !== null) {
            $obj->maxItems = $this->_maxItems;
        }
        if ($this->_uniqueItems !== null) {
            $obj->uniqueItems = $this->_uniqueItems;
        }
        return $obj;
    }

    public function prefixItems(array $items): self
    {
        $this->assertType(Type::ARRAY);
        $this->assertArrayItemsInstanceOf($items, Schema::class);
        $this->_prefixItems = $items;
        return $this;
    }

    public function items(Schema|bool $items): self
    {
        $this->assertType(Type::ARRAY);
        $this->_items = $items;
        return $this;
    }

    public function contains(Schema $contains): self
    {
        $this->assertType(Type::ARRAY);
        $this->_contains = $contains;
        return $this;
    }

    public function minContains(int $minContains): self
    {
        $this->assertType(Type::ARRAY);
        $this->_minContains = $minContains;
        return $this;
    }

    public function maxContains(int $maxContains): self
    {
        $this->assertType(Type::ARRAY);
        $this->_maxContains = $maxContains;
        return $this;
    }

    public function minItems(int $minItems): self
    {
        $this->assertType(Type::ARRAY);
        $this->_minItems = $minItems;
        return $this;
    }

    public function maxItems(int $maxItems): self
    {
        $this->assertType(Type::ARRAY);
        $this->_maxItems = $maxItems;
        return $this;
    }

    public function uniqueItems(bool $uniqueItems = true): self
    {
        $this->assertType(Type::ARRAY);
        $this->_uniqueItems = $uniqueItems;
        return $this;
    }
}
