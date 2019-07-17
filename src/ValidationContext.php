<?php declare(strict_types=1);

namespace Classic\JsonValidator;


class ValidationContext
{
    private $errors = [];

    /**
     * @var PathPointer
     */
    private $pointer;
    /**
     * @var HandlerInterface
     */
    private $handler;

    public function __construct(
        HandlerInterface $handler,
        PathPointer $pointer
    )
    {
        $this->handler = $handler;
        $this->pointer = $pointer;
    }

    public function error(string $message, array $data = []): void
    {
        $error = [
            'path' => $this->pointer->generate(),
            'message' => $message,
        ];

        if (!empty($data)) {
            $error['info'] = $data;
        }

        $this->errors[] = $error;
    }

    public function validate(&$data, $schema, string $forward = null)
    {
        if (is_null($forward)) {
            $this->handler->validate($data, $schema, $this);

            return;
        }

        $this->pointer->forward($forward);

        $this->handler->validate($data, $schema, $this);

        $this->pointer->backward();
    }

    public function forward(string $part)
    {
        $this->pointer->forward($part);
    }

    public function backward()
    {
        $this->pointer->backward();
    }

    /**
     * @return array
     */
    public function getErrors(): array
    {
        return $this->errors;
    }
}