<?php

namespace App\Tests\Scoring;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Scoring\ScoringService;
use App\Client\Entity\Client;
use App\Enum\EducationLevel;

class ScoringServiceTest extends KernelTestCase
{
    public function testSomething(): void
    {
        $kernel = self::bootKernel();

        $container = static::getContainer();
        $service = $container->get(ScoringService::class);

        $client = new Client();
        $client->setPhone('79132222323');
        $client->setEmail('user@yandex.ru');
        $client->setEducation(EducationLevel::SPECIAL);
        $client->setConsent(1);

        $result = $service->calc($client);

        $this->assertIsArray($result);
        $this->assertArrayHasKey('score', $result);
        $this->assertEquals((4+8+10+4), $result['score']);
        $this->assertIsArray($result['detail']);

        $this->assertTrue(true);
    }
}
