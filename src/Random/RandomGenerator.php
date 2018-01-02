<?php

namespace TwoFAS\Encryption\Random;

use OutOfRangeException;

/**
 * Class for generate non-cryptographical random strings.
 *
 * @package TwoFAS\Encryption
 */
class RandomGenerator
{
    const CHAR_ALPHA   = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const CHAR_DIGITS  = '0123456789';
    const CHAR_SYMBOLS = '!"#$%&\'()* +,-./:;<=>?@[\]^_`{|}~';
    const KEY_LENGTH   = 128;

    /**
     * @param int $size
     *
     * @return Str
     */
    public function string($size)
    {
        return $this->getRandom(new Str(self::CHAR_ALPHA . self::CHAR_DIGITS . self::CHAR_SYMBOLS), $size);
    }

    /**
     * @param int $size
     *
     * @return Str
     */
    public function alphaNum($size)
    {
        return $this->getRandom(new Str(self::CHAR_ALPHA . self::CHAR_DIGITS), $size);
    }

    /**
     * @param int $size
     *
     * @return Str
     */
    public function symbols($size)
    {
        return $this->getRandom(new Str(self::CHAR_SYMBOLS), $size);
    }

    /**
     * @param Str $alphabet
     * @param int $size
     *
     * @return Str
     */
    private function getRandom(Str $alphabet, $size)
    {
        $string = new Str();

        if ($size < 1) {
            return $string;
        }

        while ($string->strlen() < $size) {
            try {
                $random = openssl_random_pseudo_bytes(self::KEY_LENGTH);
                $index  = ord($random[mt_rand(0, $alphabet->strlen() - 1)]) % $alphabet->strlen();
                $string = $string->concat($alphabet->pick($index));
            } catch (OutOfRangeException $e) {

            }
        }

        return $string;
    }
}