<?php declare(strict_types=1);

namespace Classic\Package\Support\Exception;


interface ExceptionInterface
{
    public function getContext(): array;
}