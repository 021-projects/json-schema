<?php

namespace O21\JsonSchema\Concerns;

use O21\JsonSchema\Schema;
use O21\JsonSchema\Enums\Type;

trait ObjectTypeSchema
{
    protected array $_required = [];
    protected array $properties = [];
    protected array $patternProperties = [];
    protected array|bool $additionalProperties = [];
    protected array|bool $unevaluatedProperties = [];
    protected ?Schema $_propertyNames = null;
    protected ?int $_minProperties = null;
    protected ?int $_maxProperties = null;

    protected function objectObject(): \stdClass
    {
        $obj = $this->defaultObject();

        if (! empty($this->properties)) {
            $obj->properties = $this->arrayToObject($this->properties);
        }

        if (! empty($this->_required)) {
            $obj->required = $this->_required;
        }

        if (! empty($this->patternProperties)) {
            $obj->patternProperties = $this->arrayToObject($this->patternProperties);
        }

        if (! is_array($this->additionalProperties)
            || ! empty($this->additionalProperties)
        ) {
            $obj->additionalProperties = $this->additionalProperties;
        }

        if (! is_array($this->unevaluatedProperties)
            || ! empty($this->unevaluatedProperties)
        ) {
            $obj->unevaluatedProperties = $this->unevaluatedProperties;
        }

        if ($this->_propertyNames !== null) {
            $obj->propertyNames = $this->_propertyNames->toObject();
        }

        if ($this->_minProperties !== null) {
            $obj->minProperties = $this->_minProperties;
        }

        if ($this->_maxProperties !== null) {
            $obj->maxProperties = $this->_maxProperties;
        }

        return $obj;
    }

    public function addProps(array $props): void
    {
        $this->assertArrayItemsInstanceOf($props, Schema::class);
        foreach ($props as $key => $schema) {
            $this->addProp($key, $schema);
        }
    }

    public function addProp(
        string $key,
        Schema $schema,
    ): self {
        $this->assertType(Type::OBJECT);
        $this->properties[$key] = $schema;
        return $this;
    }

    public function removeProps(array|string ...$keys): void
    {
        if (count($keys) === 1 && is_array($keys[0])) {
            $keys = $keys[0];
        }

        foreach ($keys as $key) {
            $this->removeProp($key);
        }
    }

    public function removeProp(string $key): self
    {
        $this->assertType(Type::OBJECT);
        unset($this->properties[$key]);
        return $this;
    }

    public function required(array|string ...$keys): self
    {
        $this->assertType(Type::OBJECT);

        if (count($keys) === 1 && is_array($keys[0])) {
            $keys = $keys[0];
        }

        $this->_required = array_merge($this->_required, $keys);

        return $this;
    }

    public function notRequired(array|string ...$keys): self
    {
        $this->assertType(Type::OBJECT);

        if (count($keys) === 1 && is_array($keys[0])) {
            $keys = $keys[0];
        }

        $this->_required = array_diff($this->_required, $keys);

        return $this;
    }

    public function minProperties(int $min): self
    {
        $this->assertType(Type::OBJECT);

        $this->_minProperties = $min;

        return $this;
    }

    public function maxProperties(int $max): self
    {
        $this->assertType(Type::OBJECT);

        $this->_maxProperties = $max;

        return $this;
    }

    public function additionalProps(bool|Schema $props): self
    {
        $this->assertType(Type::OBJECT);

        $this->additionalProperties = $props;

        return $this;
    }

    public function unevaluatedProps(bool|Schema $props): self
    {
        $this->assertType(Type::OBJECT);

        $this->unevaluatedProperties = $props;

        return $this;
    }

    public function patternProps(array $props): self
    {
        $this->assertType(Type::OBJECT);
        $this->assertArrayItemsInstanceOf($props, Schema::class);

        $this->patternProperties = $props;

        return $this;
    }

    public function propertyNames(Schema $schema): self
    {
        $this->assertType(Type::OBJECT);

        $this->_propertyNames = $schema;

        return $this;
    }
}
