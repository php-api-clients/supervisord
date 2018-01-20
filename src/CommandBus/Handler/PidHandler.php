<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\PidCommand;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;
use function React\Promise\resolve;

final class PidHandler
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
     * @param  PidCommand       $command
     * @return PromiseInterface
     */
    public function handle(PidCommand $command): PromiseInterface
    {
        return $this->service->call('supervisor.getPID')->then(function (array $xml) {
            $pid = (int)$xml['value']['int'];

            return resolve($pid);
        });
    }
}
