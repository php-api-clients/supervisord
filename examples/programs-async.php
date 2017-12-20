<?php declare(strict_types=1);

use ApiClients\Client\Supervisord\AsyncClient;
use ApiClients\Client\Supervisord\Resource\Async\Program;
use ApiClients\Client\Supervisord\Resource\ProgramInterface;
use React\EventLoop\Factory;
use Rx\Observable;
use function ApiClients\Foundation\resource_pretty_print;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$loop = Factory::create();
$client = AsyncClient::create(require __DIR__ . DIRECTORY_SEPARATOR . 'resolve_host.php', $loop);

$client->programs()->flatMap(function (Program $program) {
    return Observable::fromPromise($program->refresh());
})->subscribe(function (ProgramInterface $program) {
    resource_pretty_print($program);
}, function ($et) {
    echo (string)$et;
});

$loop->run();
