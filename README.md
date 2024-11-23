# Object-Oriented JSON Schema Generation in PHP
<p align="center">
<a href="https://packagist.org/packages/021/json-schema"><img src="https://img.shields.io/packagist/dt/021/json-schema" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/021/json-schema"><img src="https://img.shields.io/packagist/v/021/json-schema" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/021/json-schema"><img src="https://img.shields.io/packagist/l/021/json-schema" alt="License"></a>
</p>

This library provides a way to generate JSON schemas in PHP using an object-oriented approach. It is inspired by the [JSON Schema](https://json-schema.org/) standard and aims to provide a way to generate JSON schemas in a more readable and maintainable way.

## Installation
```bash
composer require 021/json-schema
```

## Usage
```php
use O21\JsonSchema\Schema;
use O21\JsonSchema\Enums\Type;
use O21\JsonSchema\Enums\Format;

$schema = new Schema(
    schema: 'http://json-schema.org/draft-07/schema#',
    type: Type::OBJECT,
    properties: [
        'name' => new Schema(
            type: Type::STRING,
            minLength: 1,
            maxLength: 255
        ),
        'age' => new Schema(
            type: Type::INTEGER,
            minimum: 0,
            maximum: 150
        ),
        'addresses' => new Schema(
            type: Type::ARRAY,
            items: new Schema(
                type: Type::OBJECT,
                properties: [
                    'street' => new Schema(
                        type: Type::STRING,
                        minLength: 1,
                        maxLength: 255
                    ),
                    'city' => new Schema(
                        type: Type::STRING,
                        minLength: 1,
                        maxLength: 255
                    ),
                    'zip' => new Schema(
                        type: Type::STRING,
                        pattern: '^[0-9]{5}$'
                    )
                ],
                required: ['street', 'city', 'zip']
            ),
        ),
        'email' => new Schema(
            type: Type::STRING,
            format: Format::EMAIL
        ),
        'phone' => new Schema(
            type: Type::STRING,
            pattern: '^\+[0-9]{1,3}\.[0-9]{1,14}$'
        ),
        'is_active' => new Schema(
            type: Type::BOOLEAN,
            default: true,
        ),
    ]
);
// Convert the schema to JSON
$json = $schema->toJson();
// Convert the schema to an object
$obj = $schema->toObject();
```

### Transform
Almost all properties listed on the [JSON Schema reference](https://json-schema.org/understanding-json-schema/reference) are supported, but if some properties are missing in the current version of the library or you want to add your own, you can use the transform method.
It is called when the `Schema` class is transformed into the `stdClass` class to generate JSON from it:
```php
use O21\JsonSchema\Schema;

$schema = new Schema(
    transform: function (stdClass $schema): void {
        $schema->foo = 'bar';
    }
);
```

## Support Us
- **Bitcoin**: 1G4U12A7VVVaUrmj4KmNt4C5SaDmCXuW49
- **Litecoin**: LXjysogo9AHiNE7AnUm4zjprDzCCWVESai
- **Ethereum**: 0xd23B42D0A84aB51a264953f1a9c9A393c5Ffe4A1
- **Tron**: TWEcfzu2UAPsbotZJh8DrEpvdZGho79jTg
