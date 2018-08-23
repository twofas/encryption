<?php

namespace TwoFAS\Encryption\Random;

interface RandomIntGenerator
{
    /**
     * @param int $max
     *
     * @return int
     */
    public function generate($max);
}