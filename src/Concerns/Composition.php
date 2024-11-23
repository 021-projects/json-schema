<?php

namespace O21\JsonSchema\Concerns;

use O21\JsonSchema\Schema;

trait Composition
{
    protected array $_allOf = [];
    protected array $_anyOf = [];
    protected array $_oneOf = [];
    protected ?Schema $_not = null;

    public function allOf(array $schemas): self
    {
        $this->assertArrayItemsInstanceOf($schemas, Schema::class);
        $this->_allOf = $schemas;
        return $this;
    }

    public function anyOf(array $schemas): self
    {
        $this->assertArrayItemsInstanceOf($schemas, Schema::class);
        $this->_anyOf = $schemas;
        return $this;
    }

    public function oneOf(array $schemas): self
    {
        $this->assertArrayItemsInstanceOf($schemas, Schema::class);
        $this->_oneOf = $schemas;
        return $this;
    }

    public function not(Schema $schema): self
    {
        $this->_not = $schema;
        return $this;
    }

    protected function applyComposition(\stdClass $schema): void
    {
        if (! empty($this->_allOf)) {
            $schema->allOf = $this->_allOf;
        }

        if (! empty($this->_anyOf)) {
            $schema->anyOf = $this->_anyOf;
        }

        if (! empty($this->_oneOf)) {
            $schema->oneOf = $this->_oneOf;
        }

        if (! is_null($this->_not)) {
            $schema->not = $this->_not->toObject();
        }
    }
}
