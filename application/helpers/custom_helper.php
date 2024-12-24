<?php
function formatToMillions($value)
{
    $value = str_replace(',', '.', $value);
    $value = floatval($value);
    if ($value >= 1000000) {
        $formattedValue = $value / 1000000000;
        $formattedValue = round($formattedValue, 2);
        return number_format($formattedValue, 2, ',', '.');
    }
    return '0';
}
