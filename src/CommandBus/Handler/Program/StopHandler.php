<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler\Program;

use ApiClients\Client\Supervisord\CommandBus\Command\Program\StopCommand;
use ApiClients\Client\Supervisord\CommandBus\Command\ProgramsCommand;
use ApiClients\Foundation\Hydrator\Hydrator;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use React\Promise\PromiseInterface;
use function React\Promise\resolve;

final class StopHandler
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
    public function handle(StopCommand $command): PromiseInterface
    {
        return $this->service->call(
            'supervisor.stopProcess',
            [
                [
                    'param' => [
                        'value' => [
                            'string' => $command->getName(),
                        ],
                    ],
                ],
            ]
        )->then(function (array $xml) {
            $result = $xml['value']['boolean'];

            if ($result === '1') {
                return resolve(true);
            }

            if ($result === '0') {
                return resolve(true);
            }

            return resolve($result);
        });
    }
}
