<?php
namespace App\Scoring\Rule;

class PhoneScoringService
{
    private array $prefixMap = [
        '920' => 'МегаФон',
        '929' => 'МегаФон',
        '930' => 'МегаФон',
        '939' => 'МегаФон',
        '903' => 'Билайн',
        '905' => 'Билайн',
        '909' => 'Билайн',
        '960' => 'Билайн',
        '969' => 'Билайн',
        '910' => 'МТС',
        '913' => 'МТС',
        '919' => 'МТС',
        '980' => 'МТС',
        '989' => 'МТС',
    ];

    public function getOperator(string $phoneNumber): ?string
    {
        $digits = preg_replace('/\D/', '', $phoneNumber);
        $prefix = substr($digits, 1, 4);
        return $this->prefixMap[$prefix] ? $this->prefixMap[$prefix] : null;
    }

    public function getScore(string $phoneNumber): int
    {
        $operator = $this->getOperator($phoneNumber);
        return match($operator) {
            'МегаФон' => 10,
            'Билайн' => 5,
            'МТС' => 4,
            default => 1,
        };
    }
}