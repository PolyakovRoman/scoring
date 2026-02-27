<?php
namespace App\Scoring\Rule;

use App\Client\Entity\Client;
use App\Enum\EducationLevel;

class EducationRule implements ScoringRuleInterface
{
    public function getScore(Client $client): int
    {
        return match($client->getEducation()) {
            EducationLevel::SECONDARY => 5,
            EducationLevel::SPECIAL => 10,
            EducationLevel::HIGHER => 15,
            default => 0,
        };
    }
}