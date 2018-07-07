<?php declare(strict_types=1);

use ApiClients\Client\Supervisord\Client;
use ApiClients\Client\Supervisord\Options;
use function ApiClients\Foundation\resource_pretty_print;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$options = [
    Options::USERNAME => 'username',
    Options::PASSWORD => 'password',
];

$client = Client::create(require __DIR__ . DIRECTORY_SEPARATOR . 'resolve_host.php', $options);

resource_pretty_print($client->state());
