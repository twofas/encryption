<?php

namespace TwoFAS\Encryption\Random;

use PHPUnit_Framework_TestCase;

class NonCryptographicalRandomIntGeneratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var NonCryptographicalRandomIntGenerator
     */
    private $generator;

    protected function setUp()
    {
        parent::setUp();

        $this->generator = new NonCryptographicalRandomIntGenerator();
    }

    public function testNegativeMin()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->generator->generate(-1, 0);
    }

    public function testFloatMin()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->generator->generate(3.3, 100);
    }

    public function testFloatMax()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->generator->generate(3, 10.1);
    }

    public function testMaxOverByte()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->generator->generate(0, 256);
    }

    public function testMinOverMax()
    {
        $this->setExpectedException('InvalidArgumentException');

        $this->generator->generate(10, 9);
    }

    public function testWillGenerateZero()
    {
        $result = $this->generator->generate(0, 0);

        $this->assertEquals(0, $result);
    }

    public function testWillGenerateMaximum()
    {
        $max = 255;

        for ($i = 0; $i < 5000; $i++) {
            $result = $this->generator->generate(0, $max);

            if ($result === $max) {
                break;
            }
        }

        $this->assertEquals($max, $result);
    }
}
