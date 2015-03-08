<?php
namespace Tkjn\Random\Integer;

interface RandomIntegerInterface
{
    /**
     * Generate a random integer between min and max (inclusive)
     *
     * @param int $min
     * @param int $max
     * @return int
     * @throws InvalidArgumentException When min or max are not integer values
     * @throws LogicException When max < min
     */
    public function rand($min, $max);
}
