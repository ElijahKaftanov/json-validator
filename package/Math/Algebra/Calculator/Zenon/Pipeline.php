<?php declare(strict_types=1);


namespace Classic\Package\Math\Algebra\Calculator\Zenon;

use Closure;

class Pipeline
{
    protected $stack = [];
    /**
     * @var Zenon
     */
    private $calc;

    public function __construct(Zenon $calc)
    {
        $this->calc = $calc;
    }

    public function negative(): Pipeline
    {
        return $this->append(function ($value) {
            return $this->calc->neg($value);
        });
    }

    public function trim(): Pipeline
    {
        return $this->append(function (string $value) {
            return (string)(float)$value;
        });
    }

    public function float(): Pipeline
    {
        return $this->append(function ($value) {
            return (float)$value;
        });
    }

    public function integer(): Pipeline
    {
        return $this->append(function ($value) {
            return (integer)$value;
        });
    }

    public function append(Closure $closure)
    {
        $this->stack[] = $closure;

        return $this;
    }

    public function add($b)
    {
        return $this->append(function ($a) use ($b) {
            return $this->calc->add($a, $b);
        });
    }

    public function mul($b)
    {
        return $this->append(function ($a) use ($b) {
            return $this->calc->mul($a, $b);
        });
    }

    public function div($b)
    {
        return $this->append(function ($a) use ($b) {
            return $this->calc->div($a, $b);
        });
    }

    public function sub($b)
    {
        return $this->append(function ($a) use ($b) {
            return $this->calc->sub($a, $b);
        });
    }

    /**
     * @param $number
     * @return mixed
     */
    public function calc($number)
    {
        foreach ($this->stack as $closure) {
            $number = $closure($number, $this->calc);
        }

        return $number;
    }

    public function cmd(string $command)
    {
        $chain = explode('|', $command);

        foreach ($chain as $proc) {
            $this->resolveCommand($proc);
        }

        return $this;
    }

    private function resolveCommand(string $command)
    {
        $parts = explode(':', $command, 2);
        $name = $parts[0];
        $operands = explode(',', $parts[1]);

        call_user_func_array([$this, $name], $operands);
    }
}