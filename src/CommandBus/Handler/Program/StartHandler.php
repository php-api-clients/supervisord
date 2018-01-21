<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler\Program;

use ApiClients\Client\Supervisord\CommandBus\Command\Program\StartCommand;
use ApiClients\Client\Supervisord\CommandBus\Command\ProgramsCommand;
use ApiClients\Foundation\Hydrator\Hydrator;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;

final class StartHandler
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
     * @param  ProgramsCommand  $command
     * @return PromiseInterface
     */
    public function handle(StartCommand $command): PromiseInterface
    {
        return $this->service->call(
            'supervisor.startProcess',
            [
                $command->getName(),
            ]
        );
    }
}
