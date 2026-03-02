<?php

use Symfony\Component\Dotenv\Dotenv;
use Symfony\Component\Process\Process;

require dirname(__DIR__).'/vendor/autoload.php';

if (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

if ($_SERVER['APP_DEBUG']) {
    umask(0000);
}

$commands = [
    ['php', 'bin/console', 'doctrine:database:drop', '--force', '--if-exists', '--env=test'],
    ['php', 'bin/console', 'doctrine:database:create', '--env=test'],
    ['php', 'bin/console', 'doctrine:migrations:migrate', '--env=test', '--no-interaction'],
    ['php', 'bin/console', 'doctrine:fixtures:load', '--env=test', '--no-interaction'],
];

foreach ($commands as $command) {
    $process = new Process($command);
    $process->run();

    if (!$process->isSuccessful()) {
        echo $process->getErrorOutput();
        exit;
    }
}