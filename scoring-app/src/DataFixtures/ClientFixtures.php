<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Client\Entity\Client;
use App\Enum\EducationLevel;
use App\Scoring\ScoringService;

class ClientFixtures extends Fixture
{
    public function __construct(
        private ScoringService $scoringService
    ) {}

    public function load(ObjectManager $manager): void
    {
        $firstNames = array(
            'Михаил',
            'Александр',
            'Артём',
            'Матвей',
            'Дмитрий',
            'Роман',
            'Владислав',
            'Данил'
        );

        $lastNames = array(
            'Иванов',
            'Смирнов',
            'Кузнецов',
            'Попов',
            'Васильев',
            'Петров',
            'Соколов',
            'Михайлов',
        );

        $emails = array(
            '@gmail.com',
            '@yandex.ru',
            '@mail.ru',
            '@rambler.ru',
            '@yahoo.com',
        );

        $phones = array(
            '920',
            '929',
            '930',
            '939',
            '903',
            '905',
            '909',
            '960',
            '969',
            '910',
            '913',
            '919',
            '980',
            '989',
            '941',
            '952'
        );

        for ($i = 1; $i <= 50; $i++) {
            $client = new Client();
            $client->setFirstName($firstNames[array_rand($firstNames)]);
            $client->setLastName($lastNames[array_rand($lastNames)]);
            $client->setPhone('7'.$phones[array_rand($phones)].rand(1111111, 9999999));
            $client->setEmail('user'.$i.$emails[array_rand($emails)]);
            $client->setEducation(EducationLevel::cases()[array_rand(EducationLevel::cases())]);
            $client->setConsent(rand(0, 1));
            $client->setScore($this->scoringService->calc($client)['score']);

            $manager->persist($client);
        }

        $manager->flush();
    }
}
