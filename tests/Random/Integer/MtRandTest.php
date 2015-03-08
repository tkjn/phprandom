<?php
namespace TkjnTest\Random\Integer;

use Tkjn\Random\Integer\MtRand;

class MtRandTest extends \PHPUnit_Framework_TestCase
{
    use \Tkjn\TestProviders\IntegerTrait;
    private $mtRand;

    public function setup()
    {
        $this->mtRand = new MtRand();
    }

    /**
     * @dataProvider notAnIntegerProvider
     */
    public function testThrowsExceptionWhenSeedNotAnInt($seed)
    {
        if (null === $seed) {
            // null is acceptable
            return;
        }

        $this->setExpectedException('InvalidArgumentException');

        new MtRand($seed);
    }

    /**
     * @dataProvider notAnIntegerProvider
     */
    public function testThrowsExceptionWhenMinNotAnInt($min)
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->mtRand->rand($min, 0);
    }

    /**
     * @dataProvider notAnIntegerProvider
     */
    public function testThrowsExceptionWhenMaxNotAnInt($max)
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->mtRand->rand(0, $max);
    }

    /**
     * @dataProvider maxLessThanMinProvider
     */
    public function testThrowsExceptionWhenMaxLessThanMin($max, $min)
    {
        $this->setExpectedException('LogicException');

        $this->mtRand->rand($min, $max);
    }

    public function maxLessThanMinProvider()
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
