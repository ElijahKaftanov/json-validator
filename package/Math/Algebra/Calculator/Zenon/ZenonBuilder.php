<?php declare(strict_types=1);


namespace Classic\Package\Math\Algebra\Calculator\Zenon;


use Classic\Package\Support\Exception\UnexpectedValueException;

class ZenonBuilder
{
    protected $scale = 0;

    public static function create(): ZenonBuilder
    {
        return new ZenonBuilder();
    }

    public function setScale(int $scale): ZenonBuilder
    {
        if ($scale < 0) {
            throw new UnexpectedValueException('Scale could not be negative');
        }

        $this->scale = $scale;

        return $this;
    }

    public function build()
    {
        return new Zenon($this->scale);
    }
}