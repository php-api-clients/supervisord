<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord;

use React\Promise\PromiseInterface;
use Rx\Observable;

interface AsyncClientInterface
{
    public function programs(): Observable;
}
