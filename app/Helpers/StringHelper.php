<?php

namespace App\Helpers;

class StringHelper
{
    /**
     * Transform the string: capitalize the first letter and ensure it ends with a full stop.
     *
     * @param string $value
     * @return string
     */
    public static function SentenceCase(string $value): string
    {
        // Capitalize the first letter
        $value = ucfirst($value);

        // Ensure the string ends with a full stop
        if (substr($value, -1) !== '.') {
            $value .= '.';
        }

        return $value;
    }
}
