<?php
namespace App\Scoring\Service;

use App\Enum\EducationLevel;

class EducationScoringService
{
    public function getScore(?EducationLevel $educationLevel): int
    {
        return match($educationLevel) {
            EducationLevel::SECONDARY => 5,
            EducationLevel::SPECIAL => 10,
            EducationLevel::HIGHER => 15,
            default => 0,
        };
    }
}