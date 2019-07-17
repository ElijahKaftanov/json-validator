<?php declare(strict_types=1);

namespace Classic\JsonValidator\Handler;

use Classic\JsonValidator\HandlerInterface;
use Classic\JsonValidator\Schema\NumericSchema;
use Classic\JsonValidator\SchemaInterface;
use Classic\JsonValidator\ValidationContext;
use Classic\Package\Math\Algebra\Calculator\Zenon\Zenon;
use Classic\Package\Math\Algebra\Calculator\Zenon\ZenonFactory;
use Classic\Package\Support\Exception\InvalidArgumentException;

class NumericHandler implements HandlerInterface
{
    /**
     * @var Zenon
     */
    private $calc;

    public function __construct()
    {
        $this->calc = ZenonFactory::make(50);
    }

    /**
     * @param $value
     * @param SchemaInterface $schema
     * @param ValidationContext $context
     */
    public function validate(&$value, SchemaInterface $schema, ValidationContext $context)
    {
        if (!$schema instanceof NumericSchema) {
            InvalidArgumentException::supplied($schema);
        }

        $conf = $schema->getConfig();

        if (isset($config['nullable']) && is_null($value)) {
            return;
        }

        $type = gettype($value);

        if (!isset($conf['types'][$type])) {
            $context->error('number.type', ['allowed' => array_keys($conf['types'])]);
            return;
        }

        $value = (string)$value;

        if (isset($conf['cmp'])) {
            foreach ($conf['cmp'] as $condition => $compared) {
                if (!$this->calc->{$condition}($value, $compared)) {
                    $context->error("number.$condition", ['value' => $compared]);
                    break;
                }
            }
        }
    }
}