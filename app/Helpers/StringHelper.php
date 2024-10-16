<?php

namespace App\Helpers;

class StringHelper
{
    /**
     * Transform the string: capitalize the first letter, lowercase the rest and ensure it ends with a full stop.
     *
     * @param string $value
     * @return string
     */
    public static function SentenceCase(string $value): string
    {
        $value = strtolower($value);
        $value = ucfirst($value);
        if (substr($value, -1) !== '.') {
            $value .= '.';
        }
        return $value;
    }


    /**
     * Transform the string: capitalize the first letter, lowercase the rest and ensure it ends without a full stop.
     *
     * @param string $value
     * @return string
     */
    public static function DutchTitleCase(string $value): string
    {
        return ucfirst(strtolower($value));
    }
}
