<?php
namespace Tkjn\Random\Integer;

interface Random
{
    /**
     * Generate a random integer between min and max (inclusive)
     *
     * @param int $min
     * @param int $max
     * @return int
     */
    public function rand(int $min, int $max) : int;
}
