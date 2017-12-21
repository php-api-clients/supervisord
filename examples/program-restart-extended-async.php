<?php declare(strict_types=1);

use ApiClients\Client\Supervisord\AsyncClient;
use ApiClients\Client\Supervisord\Resource\Async\Program;
use React\EventLoop\Factory;
use function ApiClients\Foundation\resource_pretty_print;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';

$loop = Factory::create();
$client = AsyncClient::create(require __DIR__ . DIRECTORY_SEPARATOR . 'resolve_host.php', $loop);

$client->programs()->take(1)->subscribe(function (Program $program) {
    resource_pretty_print($program);
    $program->disable()->then(function ($result) use ($program) {
        return $program->refresh();
    })->then(function (Program $program) {
        resource_pretty_print($program);

        return $program->enable();
    })->then(function ($result) use ($program) {
        return $program->refresh();
    })->done(function (Program $program) {
        resource_pretty_print($program);
    });
}, function ($et) {
    echo (string)$et;
});

$loop->run();
