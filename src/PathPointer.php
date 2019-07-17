<?php declare(strict_types=1);

namespace Classic\JsonValidator;


class PathPointer
{
    /**
     * @var array
     */
    protected $stack;

    public function __construct()
    {
        $this->stack = new \SplStack();
    }

    public function forward(string $part): void
    {
        $this->stack->push($part);
    }

    public function backward(): void
    {
        $this->stack->pop();
    }

    public function generate(): string
    {
        $data = [];
        foreach ($this->stack as $part) {
            $data[] = $part;
        }
        $data = array_reverse($data);

        return \join('.', $data);
    }

    public function reset(): void
    {
        $this->stack = new \SplStack();
    }
}