<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ShutdownCommand;
use ApiClients\Foundation\Transport\Service\RequestService;
use ApiClients\Middleware\Xml\XmlStream;
use Psr\Http\Message\ResponseInterface;
use React\Promise\PromiseInterface;
use RingCentral\Psr7\Request;
use function React\Promise\resolve;

final class ShutdownHandler
{
    /**
     * @var RequestService
     */
    private $service;

    /**
     * @param RequestService $service
     */
    public function __construct(RequestService $service)
    {
        $this->service = $service;
    }

    /**
     * @param  ShutdownCommand  $command
     * @return PromiseInterface
     */
    public function handle(ShutdownCommand $command): PromiseInterface
    {
        return $this->service->request(new Request(
            'POST',
            '',
            [],
            new XmlStream([
                'methodCall' => [
                    'methodName' => 'supervisor.shutdown',
                ],
            ])
        ))->then(function (ResponseInterface $response) {
            $status = $response->getBody()->getParsedContents();
            $status = (bool)$status['methodResponse']['params']['param']['value']['boolean'];

            return resolve($status);
        });
    }
}
