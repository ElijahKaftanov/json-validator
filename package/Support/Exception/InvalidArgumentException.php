<?php declare(strict_types=1);

namespace Classic\Package\Support\Exception;


use Classic\Package\Support\Exception\Mixin\InvalidArgumentExceptionTrait;

class InvalidArgumentException extends LogicException
{
    use InvalidArgumentExceptionTrait;
}