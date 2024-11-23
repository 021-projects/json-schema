<?php

namespace O21\JsonSchema;

use O21\JsonSchema\Concerns\AllTypesConstruct;
use O21\JsonSchema\Concerns\ArrayTypeSchema;
use O21\JsonSchema\Concerns\Bundling;
use O21\JsonSchema\Concerns\Composition;
use O21\JsonSchema\Concerns\Conditions;
use O21\JsonSchema\Concerns\Dialect;
use O21\JsonSchema\Concerns\GenericKeywords;
use O21\JsonSchema\Concerns\Media;
use O21\JsonSchema\Concerns\NumericTypeSchema;
use O21\JsonSchema\Concerns\ObjectTypeSchema;
use O21\JsonSchema\Concerns\PropGetter;
use O21\JsonSchema\Concerns\StdBuilding;
use O21\JsonSchema\Concerns\StringTypeSchema;
use O21\JsonSchema\Concerns\Transformation;
use O21\JsonSchema\Concerns\Validation;
use O21\JsonSchema\Enums\Type;

/**
 * Class Schema
 *
 * @package O21\JsonSchema
 * @see https://json-schema.org/understanding-json-schema/reference
 */
class Schema
{
    use AllTypesConstruct;
    use ArrayTypeSchema;
    use StringTypeSchema;
    use ObjectTypeSchema;
    use NumericTypeSchema;
    use Bundling;
    use Dialect;
    use GenericKeywords;
    use Composition;
    use Conditions;
    use Media;
    use Validation;
    use Transformation;
    use StdBuilding;
    use PropGetter;

    /**
     * @throws \JsonException
     */
    public function toJson(): string
    {
        return json_encode($this->toObject(), JSON_THROW_ON_ERROR);
    }

    public function toObject(): \stdClass
    {
        $obj = match ($this->type) {
            Type::ARRAY => $this->arrayObject(),
            Type::STRING => $this->stringObject(),
            Type::OBJECT => $this->objectObject(),
            Type::NUMBER, Type::INTEGER => $this->numericObject(),
            default => $this->defaultObject(),
        };
        $this->applyDialect($obj);
        $this->applyComposition($obj);
        $this->applyGenericKeywords($obj);
        $this->applyMedia($obj);
        $this->applyConditions($obj);
        $this->applyBundling($obj);
        $this->applyTransform($obj);
        return $obj;
    }

    protected function defaultObject(): \stdClass
    {
        $obj = new \stdClass();
        if (! empty($this->type)) {
            $obj->type = $this->type->value;
        }
        return $obj;
    }
}
