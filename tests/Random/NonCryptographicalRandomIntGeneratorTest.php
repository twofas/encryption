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

    public function testWillGenerateZero()
    {
        $result = $this->generator->generate(0);

        $this->assertEquals(0, $result);
    }

    public function testWillGenerateMaximum()
    {
        $max = 255;

        for ($i = 0; $i < 5000; $i++) {
            $result = $this->generator->generate($max);

            if ($result === $max) {
                break;
            }
        }

        $this->assertEquals($max, $result);
    }
}
