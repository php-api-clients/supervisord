<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ProgramsCommand;
use ApiClients\Client\Supervisord\Resource\ProgramInterface;
use ApiClients\Foundation\Hydrator\Hydrator;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;
use function ApiClients\Tools\Rx\observableFromArray;
use function React\Promise\resolve;

final class ProgramsHandler
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
    public function handle(ProgramsCommand $command): PromiseInterface
    {
        return $this->service->call('supervisor.getAllProcessInfo')->then(function (array $xml) {
            return resolve(
                observableFromArray(
                    $xml
                )->map(function ($program) {
                    return $this->hydrator->hydrate(
                        ProgramInterface::HYDRATE_CLASS,
                        $program
                    );
                })
            );
        });
    }
}
