<?php

namespace TwoFAS\Encryption;

use TwoFAS\Encryption\Interfaces\Cipher;
use TwoFAS\Encryption\Interfaces\CryptographerInterface;
use TwoFAS\Encryption\Interfaces\KeyStorage;

class Cryptographer implements CryptographerInterface
{
    /**
     * @var Cipher
     */
    private $cipher;

    /**
     * Cryptographer constructor.
     *
     * @param Cipher $cipher
     */
    public function __construct(Cipher $cipher)
    {
        $this->cipher = $cipher;
    }

    /**
     * @param KeyStorage $keyStorage
     *
     * @return Cryptographer
     */
    public static function getInstance(KeyStorage $keyStorage)
    {
        return new self(new AESCipher(new AESIVGenerator(), $keyStorage));
    }

    /**
     * @inheritdoc
     */
    public function encrypt($data)
    {
        if (is_null($data)) {
            return null;
        }
        return $this->cipher->encrypt($data);
    }

    /**
     * @inheritdoc
     */
    public function decrypt($data)
    {
        if (is_null($data)) {
            return null;
        }
        return $this->cipher->decrypt($data);
    }
}