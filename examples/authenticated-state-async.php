<?php declare(strict_types=1);

use ApiClients\Client\Supervisord\AsyncClient;
use ApiClients\Client\Supervisord\Options;
use ApiClients\Client\Supervisord\Resource\StateInterface;
use React\EventLoop\Factory;
use function ApiClients\Foundation\resource_pretty_print;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$options = [
    Options::USERNAME => 'username',
    Options::PASSWORD => 'password',
];

$loop = Factory::create();
$client = AsyncClient::create(require __DIR__ . DIRECTORY_SEPARATOR . 'resolve_host.php', $loop, $options);

$client->state()->done(function (StateInterface $state) {
    resource_pretty_print($state);
}, function ($et) {
    echo (string)$et;
});

$loop->run();
