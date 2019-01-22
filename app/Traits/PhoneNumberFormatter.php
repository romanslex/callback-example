<?php

namespace App\Traits;

trait PhoneNumberFormatter
{
    public function formatNumber($phone)
    {
        $string = preg_replace('/[^0-9]/u', '', $phone);
        $string = ltrim($string, "7");
        return $string;
    }
}