<?php

namespace O21\JsonSchema\Concerns;

use O21\JsonSchema\Enums\Format;
use O21\JsonSchema\Enums\Type;
use O21\JsonSchema\Schema;

trait AllTypesConstruct
{
    protected array $callSetAliases = [
        'schema' => 'dialect',
        'properties' => 'addProps',
        'patternProperties' => 'patternProps',
        'additionalProperties' => 'additionalProps',
        'unevaluatedProperties' => 'unevaluatedProps',
        'minimum' => 'min',
        'maximum' => 'max',
        'exclusiveMinimum' => 'exclusiveMin',
        'exclusiveMaximum' => 'exclusiveMax',
    ];

    public function __construct(
        // Dialect
        ?string $schema = null,
        protected ?Type $type = null,
        // GenericKeywords
        ?string $title = null,
        ?string $description = null,
        mixed $default = null,
        ?array $examples = null,
        ?bool $deprecated = null,
        ?bool $readOnly = null,
        ?bool $writeOnly = null,
        ?string $comment = null,
        ?array $enum = null,
        mixed $const = null,
        // Composition
        ?array $allOf = null,
        ?array $anyOf = null,
        ?array $oneOf = null,
        ?Schema $not = null,
        // ArrayTypeSchema
        ?array $prefixItems = null,
        Schema|bool|null $items = null,
        ?Schema $contains = null,
        ?int $minContains = null,
        ?int $maxContains = null,
        ?int $minItems = null,
        ?int $maxItems = null,
        ?bool $uniqueItems = null,
        // StringTypeSchema
        ?int $minLength = null,
        ?int $maxLength = null,
        ?Format $format = null,
        ?string $pattern = null,
        // NumericTypeSchema
        ?int $minimum = null,
        ?int $maximum = null,
        int|bool|null $exclusiveMinimum = null,
        int|bool|null $exclusiveMaximum = null,
        ?int $multipleOf = null,
        // ObjectTypeSchema
        ?array $properties = null,
        ?array $required = null,
        ?array $patternProperties = null,
        array|bool|null $additionalProperties = null,
        array|bool|null $unevaluatedProperties = null,
        ?Schema $propertyNames = null,
        ?int $minProperties = null,
        ?int $maxProperties = null,
        // Conditions
        ?array $dependentRequired = null,
        ?array $dependentSchemas = null,
        ?array $if = null,
        ?array $then = null,
        ?array $else = null,
        // Media
        ?string $contentMediaType = null,
        ?string $contentEncoding = null,
        ?Schema $contentSchema = null,
        // Bundling
        protected ?string $id = null,
        protected ?string $anchor = null,
        protected ?string $ref = null,
        protected ?array $defs = null,
        // Transformation
        protected mixed $transform = null,
    ) {
        $args = get_defined_vars();
        unset($args['this']);
        $args = array_filter($args, static fn($v) => $v !== null);

        foreach ($args as $key => $value) {
            $this->callSet($key, $value);
        }
    }

    protected function callSet(string $key, mixed $value): void
    {
        if ($method = $this->callSetMethod($key)) {
            $this->$method($value);
        }
    }

    protected function callSetMethod(string $key): ?string
    {
        $method = $this->callSetAliases[$key] ?? $key;
        return method_exists($this, $method) ? $method : null;
    }
}
