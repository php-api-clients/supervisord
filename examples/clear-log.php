<?php declare(strict_types=1);

use ApiClients\Client\Supervisord\Client;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$client = Client::create(require __DIR__ . DIRECTORY_SEPARATOR . 'resolve_host.php');

if ($client->clearLog()) {
    echo 'log cleared', PHP_EOL;

    return;
}

echo 'unexpected false status', PHP_EOL;
