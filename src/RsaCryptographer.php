<?php

namespace TwoFAS\Encryption;

use TwoFAS\Encryption\Exceptions\RsaDecryptException;
use TwoFAS\Encryption\Exceptions\RsaEncryptException;
use TwoFAS\Encryption\Interfaces\CryptographerInterface;

class RsaCryptographer implements CryptographerInterface
{
    /**
     * @var string
     */
    private $publicKey;

    /**
     * @var string
     */
    private $privateKey;

    /**
     * @param string $publicKey
     * @param string $privateKey
     */
    public function __construct($publicKey, $privateKey)
    {
        $this->publicKey  = $publicKey;
        $this->privateKey = $privateKey;
    }

    /**
     * @param string $data
     *
     * @return string
     *
     * @throws RsaEncryptException
     */
    public function encrypt($data)
    {
        $public = base64_decode($this->publicKey, true);

        if (openssl_public_encrypt($data, $encrypted, $public)) {
            return base64_encode($encrypted);
        }

        throw new RsaEncryptException('Encrypting went wrong');
    }

    /**
     * @param string $data
     *
     * @return string
     *
     * @throws RsaDecryptException
     */
    public function decrypt($data)
    {
        $private = base64_decode($this->privateKey, true);

        if (openssl_private_decrypt(base64_decode($data), $decrypted, $private)) {
            return $decrypted;
        }

        throw new RsaDecryptException('Decrypting went wrong');
    }
}