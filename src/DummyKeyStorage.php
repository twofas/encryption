<?php

namespace TwoFAS\Encryption;

use TwoFAS\Encryption\Interfaces\KeyStorage;
use TwoFAS\Encryption\Interfaces\Key;

/**
 * Sample implementation of KeyStorage interface
 * Use it only as an example!
 * Class DummyKeyStorage
 * @package TwoFAS\Encryption
 */
class DummyKeyStorage implements KeyStorage
{
    /**
     * @var
     */
    private $encodedKey;

    /**
     * @param Key $key
     */
    public function storeKey(Key $key)
    {
        $this->encodedKey = base64_encode($key->getValue());
    }

    /**
     * @return string
     */
    public function retrieveKeyValue()
    {
        return base64_decode($this->encodedKey);
    }
}