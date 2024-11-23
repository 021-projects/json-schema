<?php

namespace O21\JsonSchema\Enums;

enum Type: string
{
    case OBJECT = 'object';
    case ARRAY = 'array';
    case STRING = 'string';
    case NUMBER = 'number';
    case INTEGER = 'integer';
    case BOOLEAN = 'boolean';
    case NULL = 'null';
}
