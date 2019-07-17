<?php declare(strict_types=1);


namespace Classic\JsonValidator\Schema;


use Classic\JsonValidator\SchemaInterface;

abstract class AbstractSchema implements SchemaInterface
{
    protected $config = [
        'required' => true
    ];

    /**
     * @return $this
     */
    public function optional()
    {
        $this->config['required'] = false;

        return $this;
    }

    public function isRequired(): bool
    {
        return $this->config['required'];
    }

    /**
     * @return array
     * @internal
     */
    public function getConfig(): array
    {
        return $this->config;
    }
}