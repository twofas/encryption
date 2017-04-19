<?php

namespace TwoFAS\Encryption\Interfaces;

interface CryptographerInterface
{
    /**
     * Encrypt message and return it in encrypted form
     *
     * @param string $data Message to be encrypted
     *
     * @return string|null Encrypted message
     */
    public function encrypt($data);

    /**
     * Decrypt message and return it in decrypted form
     *
     * @param string $data Message to be decrypted
     *
     * @return string|null Decrypted message
     */
    public function decrypt($data);
}