<?php

namespace TwoFAS\Encryption\Random;

use PHPUnit_Framework_TestCase;

class StrTest extends PHPUnit_Framework_TestCase
{
    public function testLength()
    {
        $string = new Str('ąbć');

        $this->assertEquals(3, $string->length());
    }

    public function testPick()
    {
        $string = new Str('ABC');

        $this->assertEquals('B', $string->pick(1));
    }

    public function testCannotPickOutOfRange()
    {
        $this->setExpectedException('OutOfRangeException');

        $string = new Str('ABC');

        $string->pick(7);
    }

    public function testConcat()
    {
        $string = new Str('ABC');

        $this->assertEquals('ABCDEF', $string->concat('DEF'));
    }

    public function testToUpper()
    {
        $string = new Str('abc');

        $this->assertEquals('ABC', $string->toUpper());
    }

    public function testToLower()
    {
        $string = new Str('ABC');

        $this->assertEquals('abc', $string->toLower());
    }

    public function testToBase64()
    {
        $string = new Str('ABC');

        $this->assertEquals('ABC', base64_decode($string->toBase64()));
    }
}
