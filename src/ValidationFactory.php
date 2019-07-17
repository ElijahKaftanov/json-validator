<?php declare(strict_types=1);

namespace Classic\JsonValidator;


use Classic\JsonValidator\Handler;
use Classic\JsonValidator\Schema;

class ValidationFactory
{
    private const SCHEMA_MAP = [
        Schema\ArraySchema::class => Handler\ArrayHandler::class,
        Schema\NumericSchema::class => Handler\NumericHandler::class,
        Schema\ObjectSchema::class => Handler\ObjectHandler::class,
        Schema\PipelineSchema::class => Handler\PipelineHandler::class,
        Schema\StringSchema::class => Handler\StringHandler::class,
    ];

    public static function makeValidator(array $config = []): JsonValidatorInterface
    {
        $schemaFactory = $config['schemaFactory'] ?? new SchemaFactory();

        $map = $config['schemaMap'] ?? [];
        foreach (self::SCHEMA_MAP as $schema => $handler) {
            if (!isset($map[$schema])) {
                $map[$schema] = new $handler;
            }
        }

        $handler = new Handler\CompositeHandler($map);

        $contextFactory = new ContextFactory($handler);

        $validator = new JsonValidator(
            $schemaFactory,
            $contextFactory
        );

        return $validator;
    }
}