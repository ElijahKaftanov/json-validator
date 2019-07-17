<?php declare(strict_types=1);


namespace Classic\JsonValidator;


use Classic\JsonValidator\Schema\ArraySchema;
use Classic\JsonValidator\Schema\NumericSchema;
use Classic\JsonValidator\Schema\ObjectSchema;
use Classic\JsonValidator\Schema\PipelineSchema;
use Classic\JsonValidator\Schema\StringSchema;

class SchemaFactory
{
    public function object(array $props = []): ObjectSchema
    {
        return (new ObjectSchema())->setProps($props);
    }

    public function string(): StringSchema
    {
        return (new StringSchema());
    }

    public function array(?SchemaInterface $prototype = null): ArraySchema
    {
        $schema = new ArraySchema();

        if (!is_null($prototype)) {
            $schema->prototype($prototype);
        }

        return $schema;
    }

    public function numeric(): NumericSchema
    {
        return new NumericSchema();
    }

    public function int(): NumericSchema
    {
        return $this->numeric()->onlyInt();
    }

    public function float(): NumericSchema
    {
        return $this->numeric()->onlyFloat();
    }

    public function numericString(): NumericSchema
    {
        return $this->numeric()->onlyString();
    }

    public function pipeline(array $stack = []): PipelineSchema
    {
        $pipeline = new PipelineSchema();

        foreach ($stack as $schema) {
            $pipeline->add($schema);
        }

        return $pipeline;
    }
}