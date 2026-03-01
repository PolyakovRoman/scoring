<?php

namespace App\Tests\Scoring\Rule;

use PHPUnit\Framework\TestCase;
use App\Scoring\Rule\EducationRule;
use App\Client\Entity\Client;
use App\Enum\EducationLevel;

class EducationTest extends TestCase
{
    private EducationRule $educationRule;

    protected function setUp(): void
    {
        $this->educationRule = new EducationRule();
    }

    public function testSecondary(): void
    {
        $client = new Client();
        $client->setEducation(EducationLevel::SECONDARY); //Среднее образование

        $this->assertEquals(5, $this->educationRule->getScore($client));
        $this->assertTrue(true);
    }

    public function testSpecial(): void
    {
        $client = new Client();
        $client->setEducation(EducationLevel::SPECIAL);

        $this->assertEquals(10, $this->educationRule->getScore($client));
        $this->assertTrue(true);
    }

    public function testHigher(): void
    {
        $client = new Client();
        $client->setEducation(EducationLevel::HIGHER);

        $this->assertEquals(15, $this->educationRule->getScore($client));
        $this->assertTrue(true);
    }
}
