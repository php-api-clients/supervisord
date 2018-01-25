<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord;

use ApiClients\Client\Supervisord\CommandBus\Command\APIVersionCommand;
use ApiClients\Client\Supervisord\CommandBus\Command\PidCommand;
use ApiClients\Client\Supervisord\CommandBus\Command\ProgramsCommand;
use ApiClients\Client\Supervisord\CommandBus\Command\RestartCommand;
use ApiClients\Client\Supervisord\CommandBus\Command\ShutdownCommand;
use ApiClients\Foundation\ClientInterface;
use ApiClients\Foundation\Factory;
use ApiClients\Foundation\Resource\ResourceInterface;
use React\EventLoop\LoopInterface;
use React\Promise\CancellablePromiseInterface;
use Rx\Observable;
use function ApiClients\Tools\Rx\unwrapObservableFromPromise;

final class AsyncClient implements AsyncClientInterface
{
    /**
     * @var ClientInterface
     */
    private $client;

    /**
     * @param ClientInterface $client
     */
    private function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    /**
     * @param  LoopInterface $loop
     * @param  array         $options
     * @return AsyncClient
     */
    public static function create(string $host, LoopInterface $loop, array $options = []): self
    {
        $options = ApiSettings::getOptions($host, $options, 'Async');
        $client = Factory::create($loop, $options);

        return new self($client);
    }

    /**
     * @internal
     * @param  ClientInterface $client
     * @return AsyncClient
     */
    public static function createFromClient(ClientInterface $client): self
    {
        return new self($client);
    }

    public function hydrate(string $resource): CancellablePromiseInterface
    {
        return $this->client->hydrate($resource);
    }

    public function extract(ResourceInterface $resource): CancellablePromiseInterface
    {
        return $this->client->extract($resource);
    }

    public function APIVersion(): CancellablePromiseInterface
    {
        return $this->client->handle(new APIVersionCommand());
    }

    public function pid(): CancellablePromiseInterface
    {
        return $this->client->handle(new PidCommand());
    }

    public function restart(): CancellablePromiseInterface
    {
        return $this->client->handle(new RestartCommand());
    }

    public function shutdown(): CancellablePromiseInterface
    {
        return $this->client->handle(new ShutdownCommand());
    }

    public function programs(): Observable
    {
        return unwrapObservableFromPromise($this->client->handle(new ProgramsCommand()));
    }
}
