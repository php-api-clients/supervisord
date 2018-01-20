<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ProgramCommand;
use ApiClients\Client\Supervisord\CommandBus\Command\ProgramsCommand;
use ApiClients\Client\Supervisord\Resource\ProgramInterface;
use ApiClients\Foundation\Hydrator\Hydrator;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;
use function React\Promise\resolve;

final class ProgramHandler
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
    public function handle(ProgramCommand $command): PromiseInterface
    {
        return $this->service->call(
            'supervisor.getProcessInfo',
            [
                $command->getName(),
            ]
        )->then(function (array $xml) {
            $program = $xml['value']['struct']['member'];

            return resolve(
                $this->hydrator->hydrate(
                    ProgramInterface::HYDRATE_CLASS,
                    (function (array $program) {
                        $data = [];

                        foreach ($program as $item) {
                            $data[$item['name']] = $item['value'][key($item['value'])];
                        }

                        return $data;
                    })($program)
                )
            );
        });
    }
}
