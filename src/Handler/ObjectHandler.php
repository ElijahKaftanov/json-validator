<?php declare(strict_types=1);

namespace Classic\JsonValidator\Handler;


use Classic\JsonValidator\HandlerInterface;
use Classic\JsonValidator\Schema\ObjectSchema;
use Classic\JsonValidator\SchemaInterface;
use Classic\JsonValidator\ValidationContext;
use Classic\Package\Support\Exception\InvalidArgumentException;

class ObjectHandler implements HandlerInterface
{
    public function validate(&$data, SchemaInterface $schema, ValidationContext $context)
    {
        if (!$schema instanceof ObjectSchema) {
            throw InvalidArgumentException::supplied($data);
        }

        $config = $schema->getConfig();

        if (isset($config['nullable']) && is_null($data)) {
            return;
        }

        if (!is_object($data)) {
            $context->error('type.object');
            return;
        }

        if (!isset($config['props'])) {
            return;
        }

        if (isset($config['not_empty'])) {
            $count = count((array)$data);
            if ($count === 0) {
                $context->error('object.empty');
            }
        }

        $props = $config['props'];

        /**
         * @var string $prop
         * @var SchemaInterface $childSchema
         */
        foreach ($props as $prop => $childSchema) {
            $context->forward($prop);

            if (!property_exists($data, $prop)) {
                if ($childSchema->isRequired()) {
                    $context->error('required');
                }
                $context->backward();
                continue;
            }

            $childData = $data->{$prop};

            $context->validate($childData, $childSchema);

            $context->backward();
        }
    }
}