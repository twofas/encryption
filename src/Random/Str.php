<?php

namespace TwoFAS\Encryption\Random;

use OutOfRangeException;

/**
 * Class Str
 *
 * @package TwoFAS\Encryption\Random
 */
class Str
{
    /**
     * @var string
     */
    private $string;

    /**
     * @param string $string
     */
    public function __construct($string = '')
    {
        $this->string = $string;
    }

    /**
     * @return int
     */
    public function strlen()
    {
        return strlen($this->string);
    }

    /**
     * @param $index
     *
     * @return string
     *
     * @throws OutOfRangeException
     */
    public function pick($index)
    {
        if ($index >= $this->strlen()) {
            throw new OutOfRangeException('Index of char is out of range.');
        }

        return $this->string[$index];
    }

    /**
     * @param $string
     *
     * @return Str
     */
    public function concat($string)
    {
        return new self($this->string . $string);
    }

    /**
     * @return Str
     */
    public function toUpper()
    {
        return new self(strtoupper($this->string));
    }

    /**
     * @return Str
     */
    public function toLower()
    {
        return new self(strtolower($this->string));
    }

    /**
     * @return Str
     */
    public function toBase64()
    {
        return new self(base64_encode($this->string));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->string;
    }
}