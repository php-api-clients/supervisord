<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord;

use ApiClients\Client\Supervisord\Resource\StateInterface;

interface ClientInterface
{
    public function APIVersion(): string;

    public function version(): string;

    public function identification(): string;

    public function state(): StateInterface;

    public function readLog(int $offset = 0, int $length = 0): string;

    public function pid(): int;

    public function restart(): bool;

    public function shutdown(): bool;

    public function programs(): array;
}
