<?php

namespace TwoFAS\Encryption;

class AESCipherTest extends \PHPUnit_Framework_TestCase
{
    private function getIVGenMock()
    {
        $stub = $this->getMockBuilder('\TwoFAS\Encryption\Interfaces\IVGenerator')->getMock();
        $stub->method('GetIV')->willReturn(base64_decode("YRqhOWWD981h1MygYSk3TQ=="));
        return $stub;
    }

    private function getKeyStorageMock()
    {
        $stub = $this->getMockBuilder('\TwoFAS\Encryption\Interfaces\KeyStorage')->getMock();
        $stub->method('RetrieveKeyValue')->willReturn(base64_decode("74r/fgXGBABzgvy/Lph0MdkCec5wKdv8EJ0+++mCxMVOm1PhyKCicnkaVyAgoBDIw3qWWLbZzRlg0yAmlF8p9WFg0ASz79+EwAvraOYng96YqtcAS+ByshThcFp7/DqL6w1KdpVuRq1y0UccnXDm8LFxIv14U/Vmj7v2UdDrdDQ="));
        return $stub;
    }

    public function testIsInstantiable()
    {
        $ivGen      = $this->getIVGenMock();
        $keyStorage = $this->getKeyStorageMock();

        $cipher = new AESCipher($ivGen, $keyStorage);
        $this->assertInstanceOf('\TwoFAS\Encryption\AESCipher', $cipher);
    }

    public function testEncryptDecrypt()
    {
        $message = "Nullam justo massa, sagittis ac luctus 1234";

        $ivGen      = $this->getIVGenMock();
        $keyStorage = $this->getKeyStorageMock();

        $cipher = new AESCipher($ivGen, $keyStorage);

        $encryptedMessage = $cipher->encrypt($message);
        $decryptedMessage = $cipher->decrypt($encryptedMessage);

        $this->assertEquals($message, $decryptedMessage);
    }

    public function testCipherOutputsExpectedEncodedData()
    {
        $message                  = "Nullam justo massa, sagittis ac luctus 1234";
        $expectedEncryptedMessage = "Q2R2Y3RvUmVKZ3FqM3ExR2RWNExZdnlMRXFWR08zZ28wRGJSRkpGN3YvZlpBVE0rWGtpY012d3U0alRYc2hLWg==:YRqhOWWD981h1MygYSk3TQ==";

        $ivGen      = $this->getIVGenMock();
        $keyStorage = $this->getKeyStorageMock();

        $cipher = new AESCipher($ivGen, $keyStorage);

        $encryptedMessage = $cipher->encrypt($message);

        $this->assertEquals($encryptedMessage, $expectedEncryptedMessage);
    }
}