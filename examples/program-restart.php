<?php declare(strict_types=1);

use ApiClients\Client\Supervisord\Client;
use React\EventLoop\Factory;
use function ApiClients\Foundation\resource_pretty_print;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$loop = Factory::create();
$client = Client::create(require __DIR__ . DIRECTORY_SEPARATOR . 'resolve_host.php');

$program = current($client->programs());
resource_pretty_print($program);
resource_pretty_print($program->restart());
