<?php declare(strict_types=1);

use ApiClients\Client\Supervisord\Client;
use function ApiClients\Foundation\resource_pretty_print;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$client = Client::create(require __DIR__ . DIRECTORY_SEPARATOR . 'resolve_host.php');

foreach ($client->programs() as $program) {
    resource_pretty_print($program);
}
