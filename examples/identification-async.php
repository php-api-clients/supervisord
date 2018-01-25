<?php declare(strict_types=1);

use ApiClients\Client\Supervisord\AsyncClient;
use React\EventLoop\Factory;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$loop = Factory::create();
$client = AsyncClient::create(require __DIR__ . DIRECTORY_SEPARATOR . 'resolve_host.php', $loop);

$client->identification()->done(function (string $pid) {
    echo 'Identification: ', $pid, PHP_EOL;
}, function ($et) {
    echo (string)$et;
});

$loop->run();
