<?php declare(strict_types=1);


namespace Classic\JsonValidator\Schema;


use Classic\JsonValidator\SchemaInterface;

class ArraySchema extends AbstractSchema
{
    public function prototype(SchemaInterface $schema)
    {
        $this->config['prototype'] = $schema;

        return $this;
    }

    public function min(int $children): self
    {
        $this->config['min'] = $children;

        return $this;
    }

    public function nullable(): self
    {
        $this->config['nullable'] = true;

        return $this;
    }

    public function max(int $children): self
    {
        $this->config['max'] = $children;

        return $this;
    }

    public function notEmpty(): self
    {
        return $this->min(1);
    }

    public function count(int $children): self
    {
        return $this->min($children)->max($children);
    }
}