<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord;

use React\Promise\CancellablePromiseInterface;
use Rx\Observable;

interface AsyncClientInterface
{
    public function APIVersion(): CancellablePromiseInterface;

    public function version(): CancellablePromiseInterface;

    public function identification(): CancellablePromiseInterface;

    public function state(): CancellablePromiseInterface;

    public function readLog(int $offset = 0, int $length = 0): CancellablePromiseInterface;

    public function pid(): CancellablePromiseInterface;

    public function shutdown(): CancellablePromiseInterface;

    public function restart(): CancellablePromiseInterface;

    public function programs(): Observable;
}
