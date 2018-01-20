<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\RestartCommand;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;
use function React\Promise\resolve;

final class RestartHandler
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
     * @param  RestartCommand   $command
     * @return PromiseInterface
     */
    public function handle(RestartCommand $command): PromiseInterface
    {
        return $this->service->call('supervisor.restart')->then(function (array $xml) {
            $status = (bool)$xml['value']['boolean'];

            return resolve($status);
        });
    }
}
