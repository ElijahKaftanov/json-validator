<?php declare(strict_types=1);

namespace Classic\Package\Support\Exception\Mixin;


trait UnexpectedValueExceptionTrait
{
    use ExceptionTrait;

    /**
     * @param string|int $argumentName
     * @param array|string $expected
     * @param $supplied
     * @return static
     */
    public static function argument($argumentName, $expected, $supplied)
    {
        if (!is_int($argumentName) || !is_string($argumentName)) {
            throw static::unexpectedType('$argumentName', ['string', 'int'], $argumentName);
        }

        if (is_string($expected)) {
            $expected = [$expected];
        } elseif (!is_array($expected)) {
            throw static::unexpectedType('$expected', ['string', 'array'], $expected);
        }
        $expected = join('|', $expected);

        if (is_object($supplied)) {
            $supplied = get_class($supplied);
        } else {
            $supplied = gettype($supplied);
        }
        return static::create("Expected argument {$argumentName} of value {$expected}. Value {$supplied} supplied instead!");
    }
}
