<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord;

use React\Promise\CancellablePromiseInterface;
use Rx\Observable;

interface AsyncClientInterface
{
    public function pid(): CancellablePromiseInterface;

    public function shutdown(): CancellablePromiseInterface;

    public function restart(): CancellablePromiseInterface;

    public function programs(): Observable;
}
