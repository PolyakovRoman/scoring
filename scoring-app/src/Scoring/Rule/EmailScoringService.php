<?php
namespace App\Scoring\Rule;

class EmailScoringService
{
    public function getDomain(string $email): string
    {
        $domain = substr(strrchr($email, "@"), 1);
        return substr($domain, 0, strrpos($domain, "."));
    }

    public function getScore(string $email): int
    {
        $domain = $this->getDomain($email);
        return match($domain) {
            'gmail' => 10,
            'yandex' => 8,
            'mail' => 6,
            default => 3,
        };
    }
}