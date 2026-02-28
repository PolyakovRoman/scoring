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
     * @return array
     */
    public function calc(Client $client): array
    {
        $result = array(
            'score' => 0,
            'detail' => array()
        );

        foreach ($this->rules as $rule) {
            $score = $rule->getScore($client);
            $result['score'] += $score;
            $result['detail'][] = $rule->getName().' ('.$rule->getValue($client).')'.': '.$score;
        }

        if($client->isConsent()){
            $result['score'] += 4;
            $result['detail'][] = 'Согласие на обработку моих личных данных : 4';
        }

        return $result;
    }
}