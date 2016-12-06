<?php
namespace TkjnTest\Random\Integer;

use PHPUnit\Framework\TestCase;
use Tkjn\Random\Integer\XorshiftStar;

class XorshiftStarTest extends TestCase
{
    private $xorshiftStar;

    public function setUp() : void
    {
        $this->xorshiftStar = new XorshiftStar();
    }

    /**
     * @dataProvider maxLessThanMinProvider
     */
    public function testThrowsExceptionWhenMaxLessThanMin(int $max, int $min) : void
    {
        $this->expectException('LogicException');
        $this->xorshiftStar->rand($min, $max);
    }

    public function maxLessThanMinProvider() : array
    {
        return [
            [10, 15],
            [1, 2],
            [0, PHP_INT_MAX],
            [~PHP_INT_MAX, PHP_INT_MAX],
            [~PHP_INT_MAX, 0],
            [-10000,-9999],
            [-1, 0],
            [-12811,90001],
        ];
    }
}
