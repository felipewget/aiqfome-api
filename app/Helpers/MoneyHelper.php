<?php

namespace App\Helpers;

class MoneyHelper
{
    public static function stringToFloat($price): float
    {
        return floatval($price) / 100;
    }

    public static function floatToString($review): string
    {
        return implode('', explode('.', $review));
    }
}