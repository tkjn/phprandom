<?php
namespace Tkjn\Random\Integer;

interface SeededRandom extends Random
{
	/**
	 * Set the random number generator seed
	 *
	 * @param int $seed
	 */
	public function seed(int $seed) : void;
}
