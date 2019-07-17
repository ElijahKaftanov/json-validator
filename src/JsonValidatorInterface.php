<?php declare(strict_types=1);

namespace Classic\JsonValidator;


interface JsonValidatorInterface
{
    public function validate(&$data, $schema);

    /**
     * @return SchemaFactory
     */
    public function getSchemaFactory();
}