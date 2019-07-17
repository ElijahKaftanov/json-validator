<?php declare(strict_types=1);

namespace Classic\Package\Math\Algebra\Calculator\Zenon;


trait ZenonTrait
{
    private $_zenon;

    protected function zenon()
    {
        if (is_null($this->_zenon)) {
            $builder = ZenonBuilder::create()->setScale(50);

            $this->configureZenonBuilder($builder);

            $this->_zenon = $builder->build();
        }

        return $this->_zenon;
    }

    protected function configureZenonBuilder(ZenonBuilder $builder)
    {
    }
}