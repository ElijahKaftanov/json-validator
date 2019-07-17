<?php declare(strict_types=1);

namespace Classic\JsonValidator\Schema;


class NumericSchema extends AbstractSchema
{
    const TYPE_INT = 'integer';
    const TYPE_FLOAT = 'float';
    const TYPE_STRING = 'string';

    public function __construct()
    {
        $this->config['types'] = ['integer' => true, 'float' => true];
    }

    public function string()
    {
        return $this->and('string');
    }

    public function onlyString(): self
    {
        return $this->only('string');
    }

    public function onlyFloat(): self
    {
        return $this->only('float');
    }

    public function onlyInt(): self
    {
        return $this->only('integer');
    }

    private function and(string $type)
    {
        $this->config['types'][$type] = true;

        return $this;
    }

    private function only(string $type): self
    {
        $this->config['types'] = [$type => true];

        return $this;
    }

    /**
     * @param string|float|int $number
     * @return NumericSchema
     */
    public function lte($number): self
    {
        return $this->cmp('lte', $number);
    }

    /**
     * @param string|float|int $number
     * @return NumericSchema
     */
    public function gt($number): self
    {
        return $this->cmp('gt', $number);
    }

    /**
     * @param string|float|int $number
     * @return NumericSchema
     */
    public function gte($number): self
    {
        return $this->cmp('gte', $number);
    }

    public function nullable(): self
    {
        $this->config['nullable'] = true;

        return $this;
    }

    /**
     * @param string|float|int $number
     * @return NumericSchema
     */
    public function lt($number): self
    {
        return $this->cmp('lt', $number);
    }

    /**
     * @param string|float|int $number
     * @return NumericSchema
     */
    public function eq($number): self
    {
        return $this->cmp('eq', $number);
    }

    private function cmp(string $type, $number)
    {
        $this->config['cmp'][$type] = (string)$number;

        return $this;
    }

    public function positive(): self
    {
        return $this->gt('0');
    }

    public function notNegative(): self
    {
        return $this->gte('0');
    }
}
