<?php declare(strict_types=1);

namespace Classic\Package\Support\Exception\Mixin;


use Classic\Package\Support\Type\Check;

trait InvalidArgumentExceptionTrait
{
    use ExceptionTrait;

    /**
     * @param string $argumentName
     * @param array|string $expected
     * @param $supplied
     * @return static
     */
    public static function unexpectedType(string $argumentName, $expected, $supplied)
    {
        $expected = self::resolveExpected($expected);
        $expected = join('|', $expected);

        $supplied = self::resolveSupplied($supplied);

        return static::create("Expected argument {$argumentName} of type {$expected}. Argument of type {$supplied} supplied instead!");
    }

    public static function assertArgumentType(string $argumentName, $expected, $argument): void
    {
        $expected = self::resolveExpected($expected);

        foreach ($expected as $type) {
            if (Check::is($argument, $type)) {
                return;
            }
        }

        static::unexpectedType($argumentName, $expected, $argument);
    }

    /**
     * @param array|string $expected
     * @return array
     */
    protected static function resolveExpected($expected): array
    {
        if (is_string($expected)) {
            $expected = [$expected];
        } elseif (!is_array($expected)) {
            throw static::unexpectedType('$expected', ['string', 'array'], $expected);
        }

        return $expected;
    }

    public static function supplied($supplied)
    {
        $supplied = self::resolveSupplied($supplied);

        return static::create("Invalid argument of type {$supplied} supplied.");
    }

    protected static function resolveSupplied($supplied): string
    {
        if (is_object($supplied)) {
            $supplied = get_class($supplied);
        } else {
            $supplied = gettype($supplied);
        }

        return $supplied;
    }
}
