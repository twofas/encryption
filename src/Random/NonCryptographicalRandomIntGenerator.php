<?php

namespace TwoFAS\Encryption\Random;

use InvalidArgumentException;
use TwoFAS\Encryption\Exceptions\RandomBytesGenerateException;

class NonCryptographicalRandomIntGenerator implements RandomIntGenerator
{
    /**
     * @param int $min
     * @param int $max
     *
     * @return int
     */
    public function generate($min, $max)
    {
        if ($min < 0 || $max > 255 || $min > $max) {
            throw new InvalidArgumentException();
        }

        $max -= $min;

        do {
            $index = ord($this->generateRandomByte());
        } while ($index > $max);

        return $min + $index;
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