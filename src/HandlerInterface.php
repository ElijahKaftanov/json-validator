<?php declare(strict_types=1);

namespace Classic\JsonValidator;


interface HandlerInterface
{
    public function validate(&$data, SchemaInterface $schema, ValidationContext $context);
}