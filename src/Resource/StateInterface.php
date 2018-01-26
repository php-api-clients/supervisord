<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource;

use ApiClients\Foundation\Resource\ResourceInterface;

interface StateInterface extends ResourceInterface
{
    const HYDRATE_CLASS = 'State';

    /**
     * @return int
     */
    public function statecode(): int;

    /**
     * @return string
     */
    public function statename(): string;
}
