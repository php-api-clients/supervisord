<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ProgramsCommand;
use ApiClients\Client\Supervisord\Resource\ProgramInterface;
use ApiClients\Foundation\Hydrator\Hydrator;
use ApiClients\Foundation\Transport\Service\RequestService;
use ApiClients\Middleware\Xml\XmlStream;
use Psr\Http\Message\ResponseInterface;
use React\Promise\PromiseInterface;
use RingCentral\Psr7\Request;
use function ApiClients\Tools\Rx\observableFromArray;
use function React\Promise\resolve;

final class ProgramsHandler
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
    public function handle(ProgramsCommand $command): PromiseInterface
    {
        return $this->service->request(new Request(
            'POST',
            '',
            [],
            new XmlStream([
                'methodCall' => [
                    'methodName' => 'supervisor.getAllProcessInfo',
                ],
            ])
        ))->then(function (ResponseInterface $response) {
            $xml = $response->getBody()->getParsedContents();
            $xml = $xml['methodResponse']['params']['param']['value']['array']['data']['value'];

            if (key($xml) === 'struct') {
                $xml = [$xml];
            }

            return resolve(
                observableFromArray(
                    $xml
                )->map(function ($program) {
                    $program = $program['struct']['member'];

                    return $this->hydrator->hydrate(
                        ProgramInterface::HYDRATE_CLASS,
                        (function (array $program) {
                            $data = [];

                            foreach ($program as $item) {
                                $data[$item['name']] = $item['value'][key($item['value'])];
                            }

                            return $data;
                        })($program)
                    );
                })
            );
        });
    }
}
