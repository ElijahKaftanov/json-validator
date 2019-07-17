<?php declare(strict_types=1);


namespace Classic\JsonValidator\Exception;


class ValidationException extends \RuntimeException
{
    /**
     * @var array
     */
    private $errors;

    public function setErrors(array $errors): self
    {
        $this->errors = $errors;

        return $this;
    }

    public function addError(array $error): self
    {
        $this->errors[] = $error;

        return $this;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public static function create(string $message = '', int $code = 0, \Throwable $previous = null)
    {
        return new static($message, $code, $previous);
    }
}