<?php

namespace App\Tests\Scoring\Rule;

use PHPUnit\Framework\TestCase;
use App\Scoring\Rule\PhoneRule;
use App\Client\Entity\Client;

class PhoneTest extends TestCase
{
    private PhoneRule $phoneRule;

    protected function setUp(): void
    {
        $this->phoneRule = new PhoneRule();
    }

    public function testMTS(): void
    {
        $client = new Client();
        $client->setPhone('+79132551708');

        $this->assertEquals(4, $this->phoneRule->getScore($client));
        $this->assertTrue(true);
    }

    public function testBeeline(): void
    {
        $client = new Client();
        $client->setPhone('+79092551708');

        $this->assertEquals(5, $this->phoneRule->getScore($client));
        $this->assertTrue(true);
    }

    public function testMegaphone(): void
    {
        $client = new Client();
        $client->setPhone('+79302551708');

        $this->assertEquals(10, $this->phoneRule->getScore($client));
        $this->assertTrue(true);
    }

    public function testOther(): void
    {
        $client = new Client();
        $client->setPhone('+72342551708');

        $this->assertEquals(1, $this->phoneRule->getScore($client));
        $this->assertTrue(true);
    }
}
