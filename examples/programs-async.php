<?php declare(strict_types=1);

use ApiClients\Client\Supervisord\AsyncClient;
use React\EventLoop\Factory;
use function ApiClients\Foundation\resource_pretty_print;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$loop = Factory::create();
$client = AsyncClient::create(require __DIR__ . DIRECTORY_SEPARATOR . 'resolve_host.php', $loop);

$client->programs()->subscribe(function ($example) {
    resource_pretty_print($example);
}, function ($et) {
    echo (string)$et;
});

$loop->run();
