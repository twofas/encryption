<?php

namespace TwoFAS\Encryption\Random;

use PHPUnit_Framework_TestCase;

class RandomGeneratorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RandomGenerator
     */
    private $generator;

    protected function setUp()
    {
        parent::setUp();

        $this->generator = new RandomGenerator();
    }

    public function testGenerateString()
    {
        $string   = $this->generator->string(128);
        $alphabet = RandomGenerator::LETTERS . RandomGenerator::DIGITS . RandomGenerator::SYMBOLS;
        $pattern  = $this->getPattern($alphabet);

        $this->assertEquals(128, strlen($string));
        $this->assertRegExp("/^[" . $pattern . "]{128}$/", $string->__toString());
    }

    public function testGenerateAlphaNum()
    {
        $string   = $this->generator->alphaNum(64);
        $alphabet = RandomGenerator::LETTERS . RandomGenerator::DIGITS;
        $pattern  = $this->getPattern($alphabet);

        $this->assertEquals(64, strlen($string));
        $this->assertRegExp("/^[" . $pattern . "]{64}$/", $string->__toString());
    }

    public function testGenerateSymbols()
    {
        $string   = $this->generator->symbols(32);
        $alphabet = RandomGenerator::SYMBOLS;
        $pattern  = $this->getPattern($alphabet);

        $this->assertEquals(32, strlen($string));
        $this->assertRegExp("/^[" . $pattern . "]{32}$/", $string->__toString());
    }

    /**
     * @param string $alphabet
     *
     * @return string
     */
    private function getPattern($alphabet)
    {
        $search      = array('/', ']');
        $replacement = array('\/', '\]');

        return str_replace($search, $replacement, $alphabet);
    }
}
