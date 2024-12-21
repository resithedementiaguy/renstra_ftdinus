<?php
if (!function_exists('formatToMillions')) {
    function formatToMillions($value)
    {
        if ($value >= 1000000) {
            $formattedValue = $value / 1000000;
            if (floor($formattedValue) == $formattedValue) {
                return number_format($formattedValue, 0, ',', '.');
            } else {
                return number_format($formattedValue, 1, ',', '.');
            }
        }
        return '0';
    }
}
