<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord;

use Rx\Observable;

interface AsyncClientInterface
{
    public function programs(): Observable;
}
