<?php

namespace TwoFAS\Encryption;

use TwoFAS\Encryption\Interfaces\Key;
use TwoFAS\Encryption\Interfaces\ReadKey;
use TwoFAS\Encryption\Interfaces\WriteKey;

/**
 * Sample implementation of ReadKey, WriteKey interface
 * Use it only as an example!
 * Class DummyKeyStorage
 *
 * @package TwoFAS\Encryption
 */
class DummyKeyStorage implements ReadKey, WriteKey
{
    /**
     * @var string
     */
    private $encodedKey;

    /**
     * @inheritdoc
     */
    public function store(Key $key)
    {
        $this->encodedKey = base64_encode($key->getValue());
    }

    /**
     * @inheritdoc
     */
    public function retrieve()
    {
        return new AESKey(base64_decode($this->encodedKey));
    }
}