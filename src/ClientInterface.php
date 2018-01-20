<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord;

interface ClientInterface
{
    public function pid(): int;

    public function restart(): bool;

    public function shutdown(): bool;

    public function programs(): array;
}
