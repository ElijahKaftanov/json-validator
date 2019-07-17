<?php declare(strict_types=1);

namespace Classic\Package\Support\Exception;


use Classic\Package\Support\Exception\Mixin\ExceptionTrait;

class DeprecatedException extends LogicException
{
    use ExceptionTrait;

    public static function method(string $method)
    {
        return static::create("Method {$method} is deprecated and should not be used anymore!");
    }
}