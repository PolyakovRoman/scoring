<?php

namespace App\Scoring;

use App\Client\Entity\Client;

class ScoringService
{
    public function __construct(private Rule\PhoneScoringService $phoneScoringService, private Rule\EmailScoringService $emailScoringService, private Rule\EducationScoringService $educationScoringService) {}

    public function calc(Client $client): int
    {
        $score = 0;

        if($client->getPhone()){
            $score += $this->phoneScoringService->getScore($client->getPhone());
        }

        if($client->getEmail()){
            $score += $this->emailScoringService->getScore($client->getEmail());
        }

        if($client->getEducation()){
            $score += $this->educationScoringService->getScore($client->getEducation());
        }

        if($client->isConsent()){
            $score += 4;
        }

        return $score;
    }
}