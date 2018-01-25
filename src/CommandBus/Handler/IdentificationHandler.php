<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\IdentificationCommand;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;

final class IdentificationHandler
{
    /**
     * @var XmlRpcService
     */
    private $service;

    /**
     * @param XmlRpcService $service
     */
    public function __construct(XmlRpcService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  IdentificationCommand $command
     * @return PromiseInterface
     */
    public function handle(IdentificationCommand $command): PromiseInterface
    {
        return $this->service->call('supervisor.getIdentification');
    }
}
