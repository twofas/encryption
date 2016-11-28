<?php

namespace TwoFAS\Encryption;

class AESKeyTest extends \PHPUnit_Framework_TestCase
{
    public function testIsInstantiable()
    {
        $key = new AESKey();

        $this->assertInstanceOf('\TwoFAS\Encryption\AESKey', $key);
    }

    public function testReturnsValidKeyLength()
    {
        $key = new AESKey();

        $this->assertEquals(strlen($key->getValue()), 128);
    }
}
