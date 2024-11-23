<?php

namespace O21\JsonSchema\Concerns;

trait Dialect
{
    protected ?string $_dialect = null;

    public function dialect(string $dialect): self
    {
        $this->_dialect = $dialect;
        return $this;
    }

    protected function applyDialect(\stdClass $schema): void
    {
        if ($this->_dialect !== null) {
            $schema->{'$schema'} = $this->_dialect;
        }
    }
}
