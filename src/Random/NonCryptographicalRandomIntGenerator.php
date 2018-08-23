<?php

namespace TwoFAS\Encryption\Random;

use TwoFAS\Encryption\Exceptions\RandomBytesGenerateException;

class NonCryptographicalRandomIntGenerator implements RandomIntGenerator
{
    /**
     * @param int $max
     *
     * @return int
     */
    public function generate($max)
    {
        do {
            $index = ord($this->generateRandomByte());
        } while ($index > $max);

        return $index;
    }

    /**
     * @return string
     */
    private function generateRandomByte()
    {
        $randomBytes = openssl_random_pseudo_bytes(1);

        if (false === $randomBytes) {
            throw new RandomBytesGenerateException((string) openssl_error_string());
        }

        return $randomBytes[0];
    }
}