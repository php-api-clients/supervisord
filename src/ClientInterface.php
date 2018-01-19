<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord;

interface ClientInterface
{
    public function pid(): int;

    public function programs(): array;
}
