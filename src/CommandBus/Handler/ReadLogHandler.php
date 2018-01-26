<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ReadLogCommand;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;

final class ReadLogHandler
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
     * @param  ReadLogCommand       $command
     * @return PromiseInterface
     */
    public function handle(ReadLogCommand $command): PromiseInterface
    {
        return $this->service->call(
            'supervisor.readLog',
            [
                $command->getOffset(),
                $command->getLength(),
            ]
        );
    }
}
