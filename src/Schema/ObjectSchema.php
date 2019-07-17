<?php declare(strict_types=1);


namespace Classic\JsonValidator\Schema;


class ObjectSchema extends AbstractSchema
{
    public function setProps(array $props): self
    {
        $this->config['props'] = $props;

        return $this;
    }

    public function optional(): self
    {
        $this->config['required'] = false;

        return $this;
    }

    public function req(): self
    {
        $this->config['required'] = true;

        return $this;
    }

    public function nullable(): self
    {
        $this->config['nullable'] = true;

        return $this;
    }

    public function notEmpty(): self
    {
        $this->config['not_empty'] = true;

        return $this;
    }

    public function isRequired(): bool
    {
        return $this->config['required'];
    }
}