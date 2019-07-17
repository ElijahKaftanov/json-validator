<?php declare(strict_types=1);

namespace Classic\JsonValidator\Handler;


use Classic\JsonValidator\HandlerInterface;
use Classic\JsonValidator\SchemaInterface;
use Classic\JsonValidator\ValidationContext;
use Classic\Package\Support\Exception\InvalidArgumentException;

class CompositeHandler implements HandlerInterface
{
    /**
     * @var array
     */
    private $schemaMap;

    public function __construct(
        array $schemaMap
    )
    {
        $this->schemaMap = $schemaMap;
    }

    public function validate(&$data, SchemaInterface $schema, ValidationContext $context)
    {
        $class = get_class($schema);

        if (!isset($this->schemaMap[$class])) {
            throw InvalidArgumentException::supplied($schema);
        }

        /** @var HandlerInterface $handler */
        $handler = $this->schemaMap[$class];

        $handler->validate($data, $schema, $context);
    }
}