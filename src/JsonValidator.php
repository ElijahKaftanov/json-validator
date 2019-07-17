<?php declare(strict_types=1);

namespace Classic\JsonValidator;

use Classic\JsonValidator\Exception\ValidationException;

class JsonValidator implements JsonValidatorInterface
{
    /**
     * @var SchemaFactory
     */
    private $schemaFactory;
    /**
     * @var ContextFactory
     */
    private $contextFactory;

    public function __construct(
        SchemaFactory $schemaFactory,
        ContextFactory $contextFactory
    )
    {
        $this->schemaFactory = $schemaFactory;
        $this->contextFactory = $contextFactory;
    }

    public function validate(&$data, $schema)
    {
        $context = $this->contextFactory->make();

        $context->validate($data, $schema);

        $errors = $context->getErrors();

        if (!empty($errors)) {
            throw ValidationException::create()->setErrors($errors);
        }
    }

    /**
     * @return SchemaFactory
     */
    public function getSchemaFactory()
    {
        return $this->schemaFactory;
    }
}