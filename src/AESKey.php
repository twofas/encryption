<?php

namespace TwoFAS\Encryption;

use TwoFAS\Encryption\Interfaces\Key;

/**
 * Class AESKey implementing Key interface.
 * @package TwoFAS\Encryption
 */
class AESKey implements Key
{
    /**
     * String representing AESKey
     * @var string
     */
    private $key;

    /**
     * Key length
     * @var int
     */
    private $keyLength = 128;

    /**
     * AESKey constructor.
     */
    public function __construct()
    {
        $this->key = openssl_random_pseudo_bytes($this->keyLength);
    }

    /**
     * Return value of key as a string.
     * @return string
     */
    public function getValue()
    {
        return $this->key;
    }
}