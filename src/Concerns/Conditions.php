<?php

namespace O21\JsonSchema\Concerns;

use O21\JsonSchema\Schema;

trait Conditions
{
    protected array $_dependentRequired = [];
    protected array $_dependentSchemas = [];
    protected array $_if = [];
    protected array $_then = [];
    protected array $_else = [];

    public function dependentRequired(array|string $key, ?array $required = null): self
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->_dependentRequired[$k] = $v;
            }
            return $this;
        }

        $this->_dependentRequired[$key] = $required;
        return $this;
    }

    public function dependentSchemas(array|string $key, ?array $schemas = null): self
    {
        if (is_array($key)) {
            foreach ($key as $k => $v) {
                $this->_dependentSchemas[$k] = $v;
            }
            return $this;
        }

        $this->_dependentSchemas[$key] = $schemas;
        return $this;
    }

    public function if(array $schemas): self
    {
        $this->assertArrayItemsInstanceOf($schemas, Schema::class);
        $this->_if = $schemas;
        return $this;
    }

    public function then(array $schemas): self
    {
        $this->assertArrayItemsInstanceOf($schemas, Schema::class);
        $this->_then = $schemas;
        return $this;
    }

    public function else(array $schemas): self
    {
        $this->assertArrayItemsInstanceOf($schemas, Schema::class);
        $this->_else = $schemas;
        return $this;
    }

    protected function applyConditions(\stdClass $schema): void
    {
        if (! empty($this->_dependentRequired)) {
            $schema->dependentRequired = $this->arrayToObject($this->_dependentRequired);
        }
        if (! empty($this->_dependentSchemas)) {
            $schema->dependentSchemas = $this->arrayToObject($this->_dependentSchemas);
        }
        if (! empty($this->_if)) {
            $schema->if = $this->mapToObject($this->_if);
        }
        if (! empty($this->_then)) {
            $schema->then = $this->mapToObject($this->_then);
        }
        if (! empty($this->_else)) {
            $schema->else = $this->mapToObject($this->_else);
        }
    }
}
