<?php
namespace Tkjn\Random\Integer;

abstract class RandomInteger implements RandomIntegerInterface
{
    abstract public function rand($min, $max);

    protected function validateInput($min, $max)
    {
        if (false === filter_var($min, FILTER_VALIDATE_INT)) {
            throw new \InvalidArgumentException('Min is not a valid int');
        }

        if (false === filter_var($max, FILTER_VALIDATE_INT)) {
            throw new \InvalidArgumentException('Max is not a valid int');
        }

        if ($max < $min) {
            throw new \LogicException('Max is less than Min');
        }
    }
}
