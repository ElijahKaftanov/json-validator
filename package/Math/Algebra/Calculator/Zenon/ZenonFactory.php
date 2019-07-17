<?php declare(strict_types=1);

namespace Classic\Package\Math\Algebra\Calculator\Zenon;


use Classic\Package\Support\Exception\UnexpectedValueException;

class ZenonFactory
{
    public static function makeBuilder(): ZenonBuilder
    {
        return new ZenonBuilder();
    }

    public static function money(): Zenon
    {
        return self::make(2);
    }

    public static function make(int $scale): Zenon
    {
        if ($scale < 0) {
            throw new UnexpectedValueException('Scale could not be negative');
        }

        return new Zenon($scale);
    }
}