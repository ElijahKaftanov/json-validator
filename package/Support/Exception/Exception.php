<?php declare(strict_types=1);

namespace Classic\Package\Support\Exception;


use Classic\Package\Support\Exception\Mixin\ExceptionTrait;

class Exception extends \Exception implements ExceptionInterface
{
    use ExceptionTrait;
}