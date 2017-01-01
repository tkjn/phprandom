<?php
namespace Tkjn\Random\Integer;

class XorshiftStar implements SeededRandom
{
    private $seed;
    private $maxSeed;

    // TODO: seed could be negative, but should be unsigned
    public function __construct(int $seed = null)
    {
        $this->maxSeed = max((int)0xFFFFFFFF, (int)0x7FFFFFFF);
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

        // TODO: These can probably result in negative numbers, need to make sure the shifts and xor are consistent with unsigned ints
        // Possible unsigned xor function here http://php.net/manual/en/language.operators.bitwise.php#58190
        /*
        function unsigned_xor32 ($a, $b)
        {
                $a1 = $a & 0x7FFF0000;
                $a2 = $a & 0x0000FFFF;
                $a3 = $a & 0x80000000;
                $b1 = $b & 0x7FFF0000;
                $b2 = $b & 0x0000FFFF;
                $b3 = $b & 0x80000000;

                $c = ($a3 != $b3) ? 0x80000000 : 0;

                return (($a1 ^ $b1) |($a2 ^ $b2)) + $c;
        }
        */
        $this->seed ^= $this->seed >> 12;
        $this->seed ^= $this->seed << 25;
        $this->seed ^= $this->seed >> 27;
        return $min + bcmod(
            bcmul(
                bccomp($this->seed, '0'),
                bcmul($this->seed, '2685821657736338717')
            ),
            $max - $min
        );
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

        if ($seed > $this->maxSeed)
        {
            throw new \InvalidArgumentException(sprintf(
                'Seed %d cannot exceed %d',
                $seed,
                $this->maxSeed
            ));
        }

        $this->seed = $seed;
    }

    private function generateSeed() : int
    {
        return random_int(0, $this->maxSeed);
    }
}
