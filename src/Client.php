<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord;

use ApiClients\Foundation\Factory as FoundationClientFactory;
use React\EventLoop\Factory;
use React\EventLoop\LoopInterface;
use Rx\React\Promise;
use function ApiClients\Tools\Rx\setAsyncScheduler;
use function Clue\React\Block\await;

final class Client implements ClientInterface
{
    /**
     * @var LoopInterface
     */
    private $loop;
    /**
     * @var AsyncClient
     */
    private $client;

    /**
     * @param LoopInterface $loop
     * @param AsyncClient   $client
     */
    private function __construct(LoopInterface $loop, AsyncClient $client)
    {
        $this->loop = $loop;
        $this->client = $client;
    }

    /**
     * @param  array  $options
     * @return Client
     */
    public static function create(string $host, array $options = []): self
    {
        $loop = Factory::create();
        $options = ApiSettings::getOptions($host, $options, 'Sync');
        $client = FoundationClientFactory::create($loop, $options);
        setAsyncScheduler($loop);
        $asyncClient = AsyncClient::createFromClient($client);

        return new self($loop, $asyncClient);
    }

    /**
     * @return array
     */
    public function programs(): array
    {
        return await(
            Promise::fromObservable(
                $this->client->programs()->toArray()
            ),
            $this->loop
        );
    }
}
