<?php declare(strict_types=1);

namespace Classic\Package\Support\Exception;


class UnexpectedValueException extends RuntimeException
{
    public static function supplied($supplied)
    {
        $supplied = self::resolveSupplied($supplied);

        return static::create("Unexpected value of type {$supplied} supplied.");
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