<?php
namespace Tkjn\Random\Integer;

class XorshiftStar implements SeededRandom
{
    private $seed;

    public function __construct(int $seed = null)
    {
        $this->seed($seed ?? $this->generateSeed());
    }

    public function rand(int $min, int $max) : int
    {
        if ($max < $min) {
            throw new \LogicException(sprintf(
                'Max %d cannot be less than min %d',
                $max,
                $min
            ));
        }

        $this->seed ^= $this->seed >> 12;
        $this->seed ^= $this->seed << 25;
        $this->seed &= 0x7FFFFFFFFFFFFFFF;
        $this->seed ^= $this->seed >> 27;
        return $min + bcmod(bcmul($this->seed, '2685821657736338717'), $max - $min);
    }

    public function seed(int $seed) : void
    {
        if (0 > $seed)
        {
            throw new \InvalidArgumentException(sprintf(
                'Seed %d cannot be less than 0',
                $seed
            ));
        }

        $this->seed = $seed;
    }

    private function generateSeed() : int
    {
        return random_int(0, PHP_INT_MAX);
    }
}
