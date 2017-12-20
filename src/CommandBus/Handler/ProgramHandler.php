<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ProgramCommand;
use ApiClients\Client\Supervisord\CommandBus\Command\ProgramsCommand;
use ApiClients\Client\Supervisord\Resource\ProgramInterface;
use ApiClients\Foundation\Hydrator\Hydrator;
use ApiClients\Foundation\Transport\Service\RequestService;
use ApiClients\Middleware\Xml\XmlStream;
use Psr\Http\Message\ResponseInterface;
use React\Promise\PromiseInterface;
use RingCentral\Psr7\Request;
use function React\Promise\resolve;

final class ProgramHandler
{
    /**
     * @var RequestService
     */
    private $service;

    /**
     * @var Hydrator
     */
    private $hydrator;

    /**
     * @param RequestService $service
     * @param Hydrator       $hydrator
     */
    public function __construct(RequestService $service, Hydrator $hydrator)
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
        return $this->service->request(new Request(
            'POST',
            '',
            [],
            new XmlStream([
                'methodCall' => [
                    'methodName' => 'supervisor.getProcessInfo',
                    'params' => [
                        [
                            'param' => [
                                'value' => [
                                    'string' => $command->getName(),
                                ],
                            ],
                        ],
                    ],
                ],
            ])
        ))->then(function (ResponseInterface $response) {
            $program = $response->getBody()->getParsedContents();
            $program = $program['methodResponse']['params']['param']['value']['struct']['member'];

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
