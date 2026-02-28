<?php
namespace App\Scoring\Rule;

use App\Client\Entity\Client;

class EmailRule implements ScoringRuleInterface
{
    public function getDomain(string $email): string
    {
        $domain = substr(strrchr($email, "@"), 1);
        return substr($domain, 0, strrpos($domain, "."));
    }

    public function getScore(Client $client): int
    {
        $domain = $this->getDomain($client->getEmail());
        return match($domain) {
            'gmail' => 10,
            'yandex' => 8,
            'mail' => 6,
            default => 3,
        };
    }

    public function getName(): string
    {
        return 'Email';
    }

    public function getValue(Client $client): string
    {
        return (string)$client->getEmail();
    }
}