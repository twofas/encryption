<?php

namespace TwoFAS\Encryption\Random;

interface RandomIntGenerator
{
    /**
     * @param int $min
     * @param int $max
     *
     * @return int
     */
    public function generate($min, $max);
}