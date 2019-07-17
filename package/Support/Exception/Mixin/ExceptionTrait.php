<?php declare(strict_types=1);

namespace Classic\Package\Support\Exception\Mixin;


use Classic\Package\Support\Exception\ExceptionInterface;

/**
 * Trait ExceptionTrait
 * @package Classic\Package\Support\Exception\Mixin
 */
trait ExceptionTrait
{
    /**
     * @var array
     */
    protected $context = [];

    public static function create(string $message = "", int $code = 0, \Throwable $previous = null)
    {
        return new static($message, $code, $previous);
    }

    /**
     * @param array $context
     * @return static|ExceptionInterface
     */
    public function setContext(array $context): ExceptionInterface
    {
        $this->context = $context;

        return $this;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}