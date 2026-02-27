<?php

namespace App\Scoring\Rule;

use App\Client\Entity\Client;

interface ScoringRuleInterface
{
    public function getScore(Client $client): int;
}