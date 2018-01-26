<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource;

use ApiClients\Foundation\Resource\EmptyResourceInterface;

abstract class EmptyState implements StateInterface, EmptyResourceInterface
{
    /**
     * @return int
     */
    public function statecode(): int
    {
        return null;
    }

    /**
     * @return string
     */
    public function statename(): string
    {
        return null;
    }
}
