<?php

namespace App\Scoring\Rule;

use App\Client\Entity\Client;
use phpDocumentor\Reflection\Types\String_;

interface ScoringRuleInterface
{
    public function getScore(Client $client): int;

    public function getName(): string;

    public function getValue(Client $client): string;
}