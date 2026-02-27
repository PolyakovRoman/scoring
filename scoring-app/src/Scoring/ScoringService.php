<?php

namespace App\Scoring;

use App\Client\Entity\Client;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;

class ScoringService
{
    public function __construct(
        #[TaggedIterator('app.scoring_rule')]
        private iterable $rules
    ) {}

    /**
     * Расчет скоринга клиентов
     *
     * @param Client $client
     * @return int
     */
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