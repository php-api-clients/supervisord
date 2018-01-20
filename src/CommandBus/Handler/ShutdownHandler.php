<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ShutdownCommand;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;
use function React\Promise\resolve;

final class ShutdownHandler
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
     * @param  ShutdownCommand  $command
     * @return PromiseInterface
     */
    public function handle(ShutdownCommand $command): PromiseInterface
    {
        return $this->service->call('supervisor.shutdown')->then(function (array $xml) {
            $status = (bool)$xml['value']['boolean'];

            return resolve($status);
        });
    }
}
