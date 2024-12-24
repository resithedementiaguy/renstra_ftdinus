<?php
if (!function_exists('formatToMillions')) {
    function formatToMillions($value)
    {
        // Pastikan nilai dalam bentuk float/double diproses dengan akurasi
        $value = floatval($value);

        if ($value >= 1000000) {
            $formattedValue = $value / 1000000; // Konversi ke jutaan
            $formattedValue = round($formattedValue, 2); // Membulatkan nilai agar akurat

            // Jika hasil dalam miliaran
            if ($formattedValue >= 1000) {
                $formattedValue = $formattedValue / 1000; // Konversi ke miliaran
                if (floor($formattedValue) == $formattedValue) {
                    return number_format($formattedValue, 0, ',', '.'); // Angka bulat tanpa desimal
                } else {
                    return number_format($formattedValue, 1, ',', '.'); // Angka desimal dengan 1 digit
                }
            }

            // Jika hasil dalam jutaan
            if (floor($formattedValue) == $formattedValue) {
                return number_format($formattedValue, 0, ',', '.'); // Angka bulat tanpa desimal
            } else {
                return number_format($formattedValue, 1, ',', '.'); // Angka desimal dengan 1 digit
            }
        }
        return '0'; // Jika nilai di bawah satu juta
    }
}
