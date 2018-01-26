<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\StateCommand;
use ApiClients\Client\Supervisord\Resource\StateInterface;
use ApiClients\Foundation\Hydrator\Hydrator;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;
use function React\Promise\resolve;

final class StateHandler
{
    /**
     * @var XmlRpcService
     */
    private $service;

    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * @param XmlRpcService $service
     * @param Hydrator      $hydrator
     */
    public function __construct(XmlRpcService $service, Hydrator $hydrator)
    {
        $this->service = $service;
        $this->hydrator = $hydrator;
    }

    /**
     * @param  StateCommand     $command
     * @return PromiseInterface
     */
    public function handle(StateCommand $command): PromiseInterface
    {
        return $this->service->call('supervisor.getState')->then(function (array $state) {
            return resolve(
                $this->hydrator->hydrate(
                    StateInterface::HYDRATE_CLASS,
                    $state
                )
            );
        });
    }
}
