<?php

namespace O21\JsonSchema\Concerns;

use O21\JsonSchema\Schema;

trait Bundling
{
    protected ?string $_id = null;
    protected ?string $_anchor = null;
    protected ?string $_ref = null;
    protected ?array $_defs = null;

    public function id(string $id): self
    {
        $this->_id = $id;
        return $this;
    }

    public function anchor(string $anchor): self
    {
        $this->_anchor = $anchor;
        return $this;
    }

    public function ref(string $ref): self
    {
        $this->_ref = $ref;
        return $this;
    }

    public function defs(array $defs): self
    {
        $this->assertArrayItemsInstanceOf($defs, Schema::class);
        $this->_defs = $defs;
        return $this;
    }

    protected function applyBundling(\stdClass $schema): void
    {
        if ($this->_id) {
            $schema->{'$id'} = $this->_id;
        }
        if ($this->_anchor) {
            $schema->{'$anchor'} = $this->_anchor;
        }
        if ($this->_ref) {
            $schema->{'$ref'} = $this->_ref;
        }
        if ($this->_defs) {
            $schema->{'$defs'} = $this->arrayToObject($this->_defs);
        }
    }
}
