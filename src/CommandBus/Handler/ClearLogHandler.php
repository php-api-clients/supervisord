<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ClearLogCommand;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;

final class ClearLogHandler
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
     * @param  ClearLogCommand       $command
     * @return PromiseInterface
     */
    public function handle(ClearLogCommand $command): PromiseInterface
    {
        return $this->service->call('supervisor.clearLog');
    }
}
