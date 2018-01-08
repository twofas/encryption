<?php

namespace TwoFAS\Encryption\Random;

use OutOfRangeException;
use TwoFAS\Encryption\Exceptions\RandomBytesGenerateException;

/**
 * Class for generate non-cryptographical random strings.
 *
 * @package TwoFAS\Encryption\Random
 */
class RandomGenerator
{
    const CHAR_ALPHA   = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const CHAR_DIGITS  = '0123456789';
    const CHAR_SYMBOLS = '!"#$%&()* +,-./:;<=>?@[]^_`{|}~';
    const KEY_LENGTH   = 128;

    /**
     * @param int $size
     *
     * @return String
     */
    public function string($size)
    {
        return $this->getRandom(new String(self::CHAR_ALPHA . self::CHAR_DIGITS . self::CHAR_SYMBOLS), $size);
    }

    /**
     * @param int $size
     *
     * @return String
     */
    public function alphaNum($size)
    {
        return $this->getRandom(new String(self::CHAR_ALPHA . self::CHAR_DIGITS), $size);
    }

    /**
     * @param int $size
     *
     * @return String
     */
    public function symbols($size)
    {
        return $this->getRandom(new String(self::CHAR_SYMBOLS), $size);
    }

    /**
     * @param String $alphabet
     * @param int    $size
     *
     * @return String
     */
    private function getRandom(String $alphabet, $size)
    {
        $string = new String();

        if ($size < 1) {
            return $string;
        }

        while ($string->length() < $size) {
            try {
                $randomBytes = openssl_random_pseudo_bytes(self::KEY_LENGTH);

                if (false === $randomBytes) {
                    throw new RandomBytesGenerateException((string) openssl_error_string());
                }

                $randomByte = $randomBytes[mt_rand(0, self::KEY_LENGTH - 1)];
                $index      = ord($randomByte) % $alphabet->length();
                $string     = $string->concat($alphabet->pick($index));
            } catch (OutOfRangeException $e) {

            }
        }

        return $string;
    }
}