<?php

declare(strict_types=1);

namespace App\Services;

class DataProcessor
{
    public function insertZeroAfterPositive(array $numbers): array
    {
        $result = [];
        foreach ($numbers as $num) {
            $result[] = $num;
            if ($num > 0) {
                $result[] = 0;
            }
        }

        return $result;
    }

    public function countWordsStartingWithConsonant(string $text): int
    {
        $words = explode(' ', $text);
        $count = 0;
        $consonants = ['b', 'c', 'd', 'f', 'g', 'h', 'j', 'k', 'l', 'm', 'n', 'p', 'q', 'r', 's', 't', 'v', 'w', 'x', 'y', 'z',
            'б', 'в', 'г', 'ґ', 'д', 'ж', 'з', 'й', 'к', 'л', 'м', 'н', 'п', 'р', 'с', 'т', 'ф', 'х', 'ц', 'ч', 'ш', 'щ'];

        foreach ($words as $word) {
            $cleanWord = trim($word);
            if ($cleanWord === '') {
                continue;
            }
            $firstLetter = mb_strtolower(mb_substr($cleanWord, 0, 1));
            if (in_array($firstLetter, $consonants, true)) {
                $count++;
            }
        }

        return $count;
    }

    public function findMaxNumberInString(string $numbersStr): float
    {
        $numbers = explode(' ', trim($numbersStr));
        $numericArray = array_map('floatval', $numbers);

        return max($numericArray);
    }
}
