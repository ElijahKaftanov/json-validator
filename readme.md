# Fast, Memory Optimized, IDE-friendly JSON Validator

```bash
composer req classic/json-validator
```

###Code
```php
$validator = ValidationFactory::makeValidator([
    'shemaMap' => [
        CityLocatesInEuropeCustomSchema::class => new CityLocatesInEuropeCustomHandler()
    ]
]);
$sf = $validator->getSchemaFactory();

$schema = $sf->object([
    'array' => $sf->array($sf->string()->email())->min(5)->max(10),
    'city' => $sf->pipeline([
        $sf->string()->enum(['Kiev', 'London', 'New York']),
        new CityLocatesInEuropeCustomSchema()
    ]),
    'moneyStringRepresentation' => $sf->numeric()->onlyString()->notNegative(),
    'nullableValue' => $sf->object()->nullable(),
    'optionalValue' => $sf->array()->optional(),
    'integer' => $sf->int()->gte(500),
]);
$schema = $sf->object(['data' => $schema]);

try {
    $validator->validate($value, $schema);
} catch (ValidationException $exception) {
    $errors = $exception->getErrors();
}
```

###Data
```json
{
  "data": {
    "array": [
      "elijah4freelance@gmail.com",
      "support@gmail.com"
    ]
  }
}
```

###Errors
```php
[
    [
        'path' => 'data.array',
        'message' => 'array.min',
        'info' => [
            'min' => 2,
        ],
    ],
    [
        'path' => 'data.array.1',
        'message' => 'string.email',
    ],
    [
        'path' => 'data.city',
        'message' => 'string.enum',
        'info' => [
            'enum' => [
                'Kiev',
                'London',
                'New York',
            ],
        ],
    ],
    [
        'path' => 'data.integer',
        'message' => 'number.gte',
        'info' => [
            'value' => '500',
        ],
    ],
];
```

