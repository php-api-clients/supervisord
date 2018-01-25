<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\APIVersionCommand;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;

final class APIVersionHandler
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
     * @param  APIVersionCommand       $command
     * @return PromiseInterface
     */
    public function handle(APIVersionCommand $command): PromiseInterface
    {
        return $this->service->call('supervisor.getAPIVersion');
    }
}
