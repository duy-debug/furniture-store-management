<?php

namespace App\Helpers;

class NumberToWords
{
    public static function convert(int $number): string
    {
        if ($number === 0) {
            return 'không';
        }

        if ($number < 0) {
            return 'âm ' . self::convert(abs($number));
        }

        $parts = [];
        $units = [
            1000000000 => 'tỷ',
            1000000 => 'triệu',
            1000 => 'nghìn',
        ];

        foreach ($units as $unitValue => $unitLabel) {
            if ($number >= $unitValue) {
                $chunk = intdiv($number, $unitValue);
                $parts[] = trim(self::convertThreeDigits($chunk) . ' ' . $unitLabel);
                $number %= $unitValue;
            }
        }

        if ($number > 0) {
            $parts[] = self::convertThreeDigits($number);
        }

        return trim(preg_replace('/\s+/', ' ', implode(' ', array_filter($parts))));
    }

    private static function convertThreeDigits(int $number): string
    {
        $ones = [
            0 => 'không',
            1 => 'một',
            2 => 'hai',
            3 => 'ba',
            4 => 'bốn',
            5 => 'năm',
            6 => 'sáu',
            7 => 'bảy',
            8 => 'tám',
            9 => 'chín',
        ];

        if ($number < 10) {
            return $ones[$number];
        }

        if ($number < 20) {
            if ($number === 10) {
                return 'mười';
            }

            if ($number === 15) {
                return 'mười lăm';
            }

            return 'mười ' . $ones[$number % 10];
        }

        if ($number < 100) {
            $tens = intdiv($number, 10);
            $onesDigit = $number % 10;

            $result = $ones[$tens] . ' mươi';
            if ($onesDigit === 0) {
                return $result;
            }

            if ($onesDigit === 1) {
                return $result . ' mốt';
            }

            if ($onesDigit === 5) {
                return $result . ' lăm';
            }

            return $result . ' ' . $ones[$onesDigit];
        }

        $hundreds = intdiv($number, 100);
        $remainder = $number % 100;
        $result = $ones[$hundreds] . ' trăm';

        if ($remainder === 0) {
            return $result;
        }

        if ($remainder < 10) {
            return $result . ' linh ' . $ones[$remainder];
        }

        return $result . ' ' . self::convertThreeDigits($remainder);
    }
}
