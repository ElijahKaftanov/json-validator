<?php declare(strict_types=1);

namespace Classic\Package\Math\Definition;

use Classic\Package\Support\Exception\UnexpectedValueException;

class RoundingMode
{
    const ROUND_HALF_UP = PHP_ROUND_HALF_UP;

    const ROUND_HALF_DOWN = PHP_ROUND_HALF_DOWN;

    const ROUND_HALF_EVEN = PHP_ROUND_HALF_EVEN;

    const ROUND_HALF_ODD = PHP_ROUND_HALF_ODD;

    const ROUND_UP = 5;

    const ROUND_DOWN = 6;

    const ROUND_HALF_POSITIVE_INFINITY = 7;

    const ROUND_HALF_NEGATIVE_INFINITY = 8;

    /**
     * Asserts that rounding mode is a valid integer value.
     *
     * @param int $roundingMode
     *
     * @throws UnexpectedValueException If $roundingMode is not valid
     */
    public static function assertValue($roundingMode)
    {
        if (!in_array(
            $roundingMode, [
            self::ROUND_HALF_DOWN, self::ROUND_HALF_EVEN, self::ROUND_HALF_ODD,
            self::ROUND_HALF_UP, self::ROUND_UP, self::ROUND_DOWN,
            self::ROUND_HALF_POSITIVE_INFINITY, self::ROUND_HALF_NEGATIVE_INFINITY,
        ], true
        )) {
            throw new UnexpectedValueException(
                'Rounding mode should be RoundingMode::ROUND_HALF_DOWN | '.
                'RoundingMode::ROUND_HALF_EVEN | RoundingMode::ROUND_HALF_ODD | '.
                'RoundingMode::ROUND_HALF_UP | RoundingMode::ROUND_UP | RoundingMode::ROUND_DOWN'.
                'RoundingMode::ROUND_HALF_POSITIVE_INFINITY | RoundingMode::ROUND_HALF_NEGATIVE_INFINITY'
            );
        }
    }
}