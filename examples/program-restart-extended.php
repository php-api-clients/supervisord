<?php declare(strict_types=1);

use ApiClients\Client\Supervisord\Client;
use function ApiClients\Foundation\resource_pretty_print;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$client = Client::create(require __DIR__ . DIRECTORY_SEPARATOR . 'resolve_host.php');

$program = current($client->programs());
resource_pretty_print($program);
$program->disable();
$program = $program->refresh();
resource_pretty_print($program);
$program->enable();
$program = $program->refresh();
resource_pretty_print($program);
