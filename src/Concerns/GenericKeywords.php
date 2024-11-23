<?php

namespace O21\JsonSchema\Concerns;

trait GenericKeywords
{
    protected ?string $_title = null;
    protected ?string $_description = null;
    protected mixed $_default = null;
    protected ?array $_examples = null;
    protected ?bool $_deprecated = null;
    protected ?bool $_readOnly = null;
    protected ?bool $_writeOnly = null;
    protected ?string $_comment = null;
    protected ?array $_enum = null;
    protected mixed $_const = null;

    public function title(string $title): static
    {
        $this->_title = $title;
        return $this;
    }

    public function description(string $description): static
    {
        $this->_description = $description;
        return $this;
    }

    public function default(mixed $default): static
    {
        $this->_default = $default;
        return $this;
    }

    public function examples(array $examples): static
    {
        $this->_examples = $examples;
        return $this;
    }

    public function deprecated(bool $deprecated = true): static
    {
        $this->_deprecated = $deprecated;
        return $this;
    }

    public function readOnly(bool $readOnly = true): static
    {
        $this->_readOnly = $readOnly;
        return $this;
    }

    public function writeOnly(bool $writeOnly = true): static
    {
        $this->_writeOnly = $writeOnly;
        return $this;
    }

    public function comment(string $comment): static
    {
        $this->_comment = $comment;
        return $this;
    }

    public function enum(array $enum): static
    {
        $this->_enum = $enum;
        return $this;
    }

    public function const(mixed $const): static
    {
        $this->_const = $const;
        return $this;
    }

    protected function applyGenericKeywords(\stdClass $schema): void
    {
        if ($this->_title !== null) {
            $schema->title = $this->_title;
        }

        if ($this->_description !== null) {
            $schema->description = $this->_description;
        }

        if ($this->_default !== null) {
            $schema->default = $this->_default;
        }

        if ($this->_examples !== null) {
            $schema->examples = $this->_examples;
        }

        if ($this->_deprecated !== null) {
            $schema->deprecated = $this->_deprecated;
        }

        if ($this->_readOnly !== null) {
            $schema->readOnly = $this->_readOnly;
        }

        if ($this->_writeOnly !== null) {
            $schema->writeOnly = $this->_writeOnly;
        }

        if ($this->_comment !== null) {
            $schema->{'$comment'} = $this->_comment;
        }

        if ($this->_enum !== null) {
            $schema->enum = $this->_enum;
        }

        if ($this->_const !== null) {
            $schema->const = $this->_const;
        }
    }
}
