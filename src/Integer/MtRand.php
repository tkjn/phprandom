<?php
namespace Tkjn\Random\Integer;

class MtRand extends RandomInteger
{
    public function __construct($seed = null)
    {
        if (null !== $seed) {
            if (false === filter_var($seed, FILTER_VALIDATE_INT)) {
                throw new \InvalidArgumentException('Seed is not a valid int');
            }
            mt_srand($seed);
        }
    }

    public function rand($min, $max)
    {
        $this->validateInput($min, $max);

        return mt_rand($min, $max);
    }
}
