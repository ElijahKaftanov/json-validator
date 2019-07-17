<?php declare(strict_types=1);


namespace Classic\JsonValidator\Schema;


class StringSchema extends AbstractSchema
{
    public function min(int $integer): self
    {
        $this->config['min'] = $integer;

        return $this;
    }

    public function max(int $integer): self
    {
        $this->config['max'] = $integer;

        return $this;
    }

    public function enum(array $enum): self
    {
        $this->config['enum'] = array_flip($enum);

        return $this;
    }

    public function nullable(): self
    {
        $this->config['nullable'] = true;

        return $this;
    }

    public function notEmpty(): self
    {
        return $this->min(1);
    }

    public function len(int $length): self
    {
        return $this->min($length)->max($length);
    }

    public function req(): self
    {
        $this->config['required'] = true;

        return $this;
    }

    public function date(): self
    {
        $this->config['date'] = true;

        return $this;
    }

    public function email(): self
    {
        $this->config['email'] = true;

        return $this;
    }

    public function isRequired(): bool
    {
        return $this->config['required'] ?? false;
    }
}