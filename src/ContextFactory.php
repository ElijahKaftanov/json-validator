<?php declare(strict_types=1);

namespace Classic\JsonValidator;


class ContextFactory
{
    /**
     * @var HandlerInterface
     */
    private $handler;

    public function __construct(
        HandlerInterface $handler
    )
    {
        $this->handler = $handler;
    }

    public function make(): ValidationContext
    {
        $pointer = new PathPointer();
        $handler = $this->handler;

        $context = new ValidationContext(
            $handler,
            $pointer
        );

        return $context;
    }
}