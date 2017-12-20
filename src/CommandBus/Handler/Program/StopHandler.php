<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler\Program;

use ApiClients\Client\Supervisord\CommandBus\Command\Program\StopCommand;
use ApiClients\Client\Supervisord\CommandBus\Command\ProgramsCommand;
use ApiClients\Foundation\Hydrator\Hydrator;
use ApiClients\Foundation\Transport\Service\RequestService;
use ApiClients\Middleware\Xml\XmlStream;
use Psr\Http\Message\ResponseInterface;
use React\Promise\PromiseInterface;
use RingCentral\Psr7\Request;
use function React\Promise\resolve;

final class StopHandler
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
    public function handle(StopCommand $command): PromiseInterface
    {
        return $this->service->request(new Request(
            'POST',
            '',
            [],
            new XmlStream([
                'methodCall' => [
                    'methodName' => 'supervisor.stopProcess',
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
            $result = $response->getBody()->getParsedContents();
            $result = $result['methodResponse']['params']['param']['value']['boolean'];

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
