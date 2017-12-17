<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord;

interface ClientInterface
{
    public function programs(): array;
}
