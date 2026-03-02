<?php

namespace App\Tests\Command;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use App\Command\ScoringCalcCommand;

class ScoringCalcCommandTest extends KernelTestCase
{
    public function testWithoutID(): void
    {
        $kernel = self::bootKernel();

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $command = $application->find('app:scoring-calc');
        $commandTester = new CommandTester($command);

        $commandTester->execute([]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Скоринг для клиента', $output);

        $this->assertEquals(0, $commandTester->getStatusCode());
    }

    public function testWithID(): void
    {
        $kernel = self::bootKernel();

        $application = new Application($kernel);
        $application->setAutoExit(false);

        $command = $application->find('app:scoring-calc');
        $commandTester = new CommandTester($command);

        $commandTester->execute([
            'id' => 10,
        ]);

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Скоринг для клиента', $output);

        $this->assertEquals(0, $commandTester->getStatusCode());
    }
}
