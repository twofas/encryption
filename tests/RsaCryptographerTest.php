<?php

namespace TwoFAS\Encryption;

class RsaCryptographerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var string
     */
    private $keyPublic;

    /**
     * @var string
     */
    private $keyPrivate;

    /**
     * @var string
     */
    private $secondPrivateKey;

    /**
     * @param null   $name
     * @param array  $data
     * @param string $dataName
     */
    public function __construct($name = null, array $data = array(), $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        $pair                   = require 'rsa_key_pair_1.php';
        $secondPair             = require 'rsa_key_pair_2.php';
        $this->keyPublic        = $pair['public'];
        $this->keyPrivate       = $pair['private'];
        $this->secondPrivateKey = $secondPair['private'];
    }


    public function testEncryptDecrypt()
    {
        $cryptographer = new RsaCryptographer($this->keyPublic, $this->keyPrivate);

        $encrypted = $cryptographer->encryptToBase64('foobar');

        $this->assertEquals('foobar', $cryptographer->decryptBase64($encrypted));
    }

    public function testDecryptError()
    {
        $this->setExpectedException('\TwoFAS\Encryption\Exceptions\RsaDecryptException');

        $cryptographer = new RsaCryptographer($this->keyPublic, $this->secondPrivateKey);
        $encrypted     = $cryptographer->encryptToBase64('foobar');

        $cryptographer->decryptBase64($encrypted);
    }
}
