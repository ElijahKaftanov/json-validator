<?php declare(strict_types=1);

namespace Classic\JsonValidator\Handler;

use Classic\JsonValidator\HandlerInterface;
use Classic\JsonValidator\Schema\StringSchema;
use Classic\JsonValidator\SchemaInterface;
use Classic\JsonValidator\ValidationContext;
use Classic\Package\Support\Exception\InvalidArgumentException;

class StringHandler implements HandlerInterface
{
    public function validate(&$value, SchemaInterface $schema, ValidationContext $context)
    {
        if (!$schema instanceof StringSchema) {
            throw InvalidArgumentException::supplied($value);
        }

        $config = $schema->getConfig();

        if (isset($config['nullable']) && is_null($value)) {
            return;
        }

        if (isset($config['min'])) {
            $min = $config['min'];
            if (mb_strlen($value) < $min) {
                $context->error('string.min', ['min' => $min]);
            }
        }

        if (isset($config['max'])) {
            $max = $config['max'];
            if (mb_strlen($value) > $max) {
                $context->error('string.max', ['max' => $max]);
            }
        }

        if (isset($config['email'])) {
            if (filter_var($value, FILTER_VALIDATE_EMAIL) === false) {
                $context->error('string.email');
            }
        }

        if (isset($config['enum'])) {
            if (!isset($config['enum'][$value])) {
                $context->error('string.enum', ['enum' => array_flip($config['enum'])]);
            }
        }
    }
}