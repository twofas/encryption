<?php

namespace TwoFAS\Encryption\Random;

use PHPUnit_Framework_TestCase;

class StringTest extends PHPUnit_Framework_TestCase
{
    public function testLength()
    {
        $string = new String('ąbć');

        $this->assertEquals(3, $string->length());
    }

    public function testPick()
    {
        $string = new String('ABC');

        $this->assertEquals('B', $string->pick(1));
    }

    public function testConcat()
    {
        $string = new String('ABC');

        $this->assertEquals('ABCDEF', $string->concat('DEF'));
    }

    public function testToUpper()
    {
        $string = new String('abc');

        $this->assertEquals('ABC', $string->toUpper());
    }

    public function testToLower()
    {
        $string = new String('ABC');

        $this->assertEquals('abc', $string->toLower());
    }

    public function testToBase64()
    {
        $string = new String('ABC');

        $this->assertEquals('ABC', base64_decode($string->toBase64()));
    }
}
