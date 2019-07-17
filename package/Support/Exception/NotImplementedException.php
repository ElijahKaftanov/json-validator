<?php declare(strict_types=1);

namespace Classic\Package\Support\Exception;


use Throwable;

class NotImplementedException extends LogicException
{
    public function __construct(string $message = "Not implemented!", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function method(string $method)
    {
        return new static("Class method {$method} is not implemented!");
    }
}