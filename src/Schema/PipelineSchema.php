<?php declare(strict_types=1);

namespace Classic\JsonValidator\Schema;

use Classic\JsonValidator\SchemaInterface;

class PipelineSchema extends AbstractSchema
{
    public function add(SchemaInterface $schema)
    {
        $this->config['stack'][] = $schema;

        return $this;
    }

//    public function isRequired(): bool
//    {
//        /** @var SchemaInterface $schema */
//        foreach ($this->config['stack'] as $schema) {
//            if ($schema->isRequired()) {
//                return true;
//            }
//        }
//
//        return false;
//    }
}