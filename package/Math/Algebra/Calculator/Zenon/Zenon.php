<?php declare(strict_types=1);


namespace Classic\Package\Math\Algebra\Calculator\Zenon;


use Classic\Package\Math\Definition\RoundingMode;
use Classic\Package\Support\Exception\NotImplementedException;
use Classic\Package\Support\Tool\Iter;

class Zenon
{
    protected $scale;

    public function __construct(
        int $scale
    )
    {
        $this->scale = $scale;
    }

    public function sum(iterable $iterable): string
    {
        return Iter::reduce($iterable, '0.0', function (string $init, string $addend) {
            return $this->add($init, $addend);
        });
    }

    public function cmp($a, $b): int
    {
        return bccomp($this->num($a), $this->num($b), $this->scale);
    }

    public function mod($a, $b): string
    {
        return bcmod($this->num($a), $this->num($b), $this->scale);
    }

    public function gte($value, $then): bool
    {
        return $this->cmp($value, $then) !== -1;
    }

    public function lte($value, $then): bool
    {
        return $this->cmp($value, $then) !== 1;
    }

    public function gt($value, $then): bool
    {
        return $this->cmp($value, $then) === 1;
    }

    public function lt($value, $then): bool
    {
        return $this->cmp($value, $then) === -1;
    }

    public function eq($value, $then): bool
    {
        return $this->cmp($value, $then) === 0;
    }

    public function isPositive($value): bool
    {
        return $this->cmp($value, '0') === 1;
    }

    public function isNegative($value): bool
    {
        return $this->cmp($value, '0') === -1;
    }

    public function isZero($value): bool
    {
        return $this->cmp($value, '0') === 0;
    }

    /**
     * Negative
     *
     * @param $value
     * @return string
     */
    public function neg($value): string
    {
        return $this->mul($value, '-1');
    }

    public function mul($left, $right): string
    {
        return bcmul($this->num($left), $this->num($right), $this->scale);
    }

    public function sub($left, $right): string
    {
        return bcsub($this->num($left), $this->num($right), $this->scale);
    }

    public function div($dividend, $divisor): string
    {
        return bcdiv($this->num($dividend), $this->num($divisor), $this->scale);
    }

    public function add($left, $right): string
    {
        return bcadd($this->num($left), $this->num($right), $this->scale);
    }

    public function ship($value): Vessel
    {
        return new Vessel($this->num($value), $this);
    }

    private function num($value): string
    {
//        if (!is_numeric($value)) {
//            throw InvalidArgumentException::unexpectedType(
//                '$value',
//                'numeric',
//                $value
//            );
//        }

        return (string)$value;
    }

    /**
     * @param int|float|string $value
     * @param int $precision
     * @return static
     */
    public function floor($value, int $precision = 0): string
    {
        return $this->round($value, $precision, RoundingMode::ROUND_DOWN);
    }

    /**
     * @param int|float|string $value
     * @param int $precision
     * @param int $roundingMode
     * @return static
     */
    public function round($value, int $precision = 0, $roundingMode = RoundingMode::ROUND_HALF_UP): string
    {
        $value = $this->num($value);

        RoundingMode::assertValue($roundingMode);

        if ($roundingMode === RoundingMode::ROUND_HALF_UP) {
            return (string)\round((float)$value, $precision, $roundingMode);
        }
        if ($roundingMode === RoundingMode::ROUND_DOWN) {
            $fig = (int) str_pad('1', $precision + 1, '0');
            return (string)(floor($value * $fig) / $fig);
        }

        throw new NotImplementedException;
    }

    public function absolute($number): string
    {
        $number = $this->num($number);

        if ($number[0] === '-') {
            $number = substr($number, 1);
        }

        return $number;
    }

    /**
     * @param $a
     * @param $b
     * @return string[] [a, b, subtracted]
     */
    public function subtractToZero($a, $b): array
    {
        $a = $this->num($a);
        $b = $this->num($b);

        $delta = $this->sub($a, $b);
        if ($this->isNegative($delta)) {
            return ['0', $this->absolute($delta), $a];
        } else {
            return [$delta, '0', $b];
        }
    }
}