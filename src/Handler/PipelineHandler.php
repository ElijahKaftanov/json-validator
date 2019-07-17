<?php declare(strict_types=1);

namespace Classic\JsonValidator\Handler;


use Classic\JsonValidator\HandlerInterface;
use Classic\JsonValidator\Schema\PipelineSchema;
use Classic\JsonValidator\SchemaInterface;
use Classic\JsonValidator\ValidationContext;
use Classic\Package\Support\Exception\InvalidArgumentException;

class PipelineHandler implements HandlerInterface
{
    public function validate(&$data, SchemaInterface $schema, ValidationContext $context)
    {
        if (!$schema instanceof PipelineSchema) {
            throw InvalidArgumentException::supplied($data);
        }

        $config = $schema->getConfig();

        $stack = $config['stack'] ?? [];
        foreach ($stack as $schema) {
            $context->validate($data, $schema);
        }
    }
}