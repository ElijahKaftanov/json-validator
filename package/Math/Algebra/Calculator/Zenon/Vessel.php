<?php declare(strict_types=1);


namespace Classic\Package\Math\Algebra\Calculator\Zenon;


use Classic\Package\Math\Definition\RoundingMode;

class Vessel
{
    /**
     * @var string
     */
    private $value;
    /**
     * @var Zenon
     */
    private $calc;

    public function __construct(
        string $value,
        Zenon $calc
    )
    {
        $this->value = $value;
        $this->calc = $calc;
    }

    public function add($addend): Vessel
    {
        $this->value = $this->calc->add($this->value, $addend);

        return $this;
    }

    public function sub($subtrahend): Vessel
    {
        $this->value = $this->calc->sub($this->value, $subtrahend);

        return $this;
    }

    public function mul($multiplier): Vessel
    {
        $this->value = $this->calc->mul($this->value, $multiplier);

        return $this;
    }

    public function div($divisor): Vessel
    {
        $this->value = $this->calc->div($this->value, $divisor);

        return $this;
    }

    public function round(int $precision, $roundingMode = RoundingMode::ROUND_HALF_UP): Vessel
    {
        $this->value = $this->calc->round($this->value, $precision, $roundingMode);

        return $this;
    }

    public function neg(): Vessel
    {
        $this->value = $this->calc->neg($this->value);

        return $this;
    }

    public function trim(): Vessel
    {
        $this->value = (string)(float)$this->value;

        return $this;
    }

    public function float(): float
    {
        return (float)$this->value;
    }

    public function integer(): float
    {
        return (integer)$this->value;
    }

    public function string(): string
    {
        return $this->value;
    }
}