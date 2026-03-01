<?php

namespace App\Tests\Scoring\Rule;

use PHPUnit\Framework\TestCase;
use App\Scoring\Rule\EmailRule;
use App\Client\Entity\Client;

class EmailTest extends TestCase
{
    private EmailRule $emailRule;

    protected function setUp(): void
    {
        $this->emailRule = new EmailRule();
    }

    public function testGmail(): void
    {
        $client = new Client();
        $client->setEmail('user@gmail.com');

        $this->assertEquals(10, $this->emailRule->getScore($client));
        $this->assertTrue(true);
    }

    public function testYandex(): void
    {
        $client = new Client();
        $client->setEmail('user@yandex.ru');

        $this->assertEquals(8, $this->emailRule->getScore($client));
        $this->assertTrue(true);
    }

    public function testMail(): void
    {
        $client = new Client();
        $client->setEmail('user@mail.ru');

        $this->assertEquals(6, $this->emailRule->getScore($client));
        $this->assertTrue(true);
    }

    public function testOther(): void
    {
        $client = new Client();
        $client->setEmail('user@yahoo.com');

        $this->assertEquals(3, $this->emailRule->getScore($client));
        $this->assertTrue(true);
    }
}
