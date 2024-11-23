<?php

namespace O21\JsonSchema\Concerns;

use O21\JsonSchema\Schema;

trait Media
{
    protected ?string $_contentEncoding = null;
    protected ?string $_contentMediaType = null;
    protected ?Schema $_contentSchema = null;

    public function contentEncoding(string $contentEncoding): self
    {
        $this->_contentEncoding = $contentEncoding;
        return $this;
    }

    public function contentMediaType(string $contentMediaType): self
    {
        $this->_contentMediaType = $contentMediaType;
        return $this;
    }

    public function contentSchema(Schema $contentSchema): self
    {
        $this->_contentSchema = $contentSchema;
        return $this;
    }

    protected function applyMedia(\stdClass $schema): void
    {
        if ($this->_contentEncoding !== null) {
            $schema->contentEncoding = $this->_contentEncoding;
        }

        if ($this->_contentMediaType !== null) {
            $schema->contentMediaType = $this->_contentMediaType;
        }

        if ($this->_contentSchema !== null) {
            $schema->contentSchema = $this->_contentSchema->toObject();
        }
    }
}
