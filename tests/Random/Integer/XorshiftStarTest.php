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


    /**
     * @dataProvider seedProvider
     */
    public function testTheSameSeedProducesTheSameResults(int $seed) : void
    {
        $rand1 = new XorshiftStar($seed);
        $rand2 = new XorshiftStar($seed);

        $this->assertSame($rand1->rand(10, 100), $rand2->rand(10, 100));
        $this->assertSame($rand1->rand(0, 12737123), $rand2->rand(0, 12737123));
    }

    /**
     * @dataProvider lessThanZeroProvider
     */
    public function testThrowsExceptionWhenSeedLessThanZero(int $seed) : void
    {
        $this->expectException('InvalidArgumentException');
        $this->xorshiftStar->seed($seed);
    }

    public function maxLessThanMinProvider() : array
    {
        return [
            [10, 15],
            [1, 2],
            [0, PHP_INT_MAX],
            [~PHP_INT_MAX, PHP_INT_MAX],
            [~PHP_INT_MAX, 0],
            [-10000, -9999],
            [-1, 0],
            [-12811, 90001],
        ];
    }

    public function seedProvider() : array
    {
        return [
            [0],
            [123123],
            [PHP_INT_MAX],
        ];
    }

    public function lessThanZeroProvider() : array
    {
        return [
            [-1],
            [~PHP_INT_MAX],
        ];
    }
}
