<?php

namespace App\Scoring;

use App\Client\Entity\Client;
use App\Scoring\Rule\PhoneRule;
use App\Scoring\Rule\EmailRule;
use App\Scoring\Rule\EducationRule;

class ScoringService
{
    private array $rules;

    public function __construct() {

        $this->rules = [
            new PhoneRule(),
            new EmailRule(),
            new EducationRule()
        ];
    }

    public function calc(Client $client): int
    {
        $score = 0;

        foreach ($this->rules as $rule) {
            $score += $rule->getScore($client);
        }

        if($client->isConsent()){
            $score += 4;
        }

        return $score;
    }
}