<?php declare(strict_types=1);

namespace ApiClients\Tests\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ProgramsCommand;
use ApiClients\Client\Supervisord\CommandBus\Handler\ProgramsHandler;
use ApiClients\Client\Supervisord\Resource\ProgramInterface;
use ApiClients\Client\Supervisord\Resource\StateInterface;
use ApiClients\Foundation\Hydrator\Hydrator;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use ApiClients\Tools\TestUtilities\TestCase;
use Rx\React\Promise;
use function ApiClients\Tools\Rx\unwrapObservableFromPromise;
use function React\Promise\resolve;

final class ProgramsHandlerTest extends TestCase
{
    public function testCommand()
    {
        $program = [
            'name' => 'ping',
        ];

        $resource = $this->prophesize(StateInterface::class)->reveal();

        $service = $this->prophesize(XmlRpcService::class);
        $service->call('supervisor.getAllProcessInfo')->shouldBeCalled()->willReturn(resolve([$program]));

        $hydrator = $this->prophesize(Hydrator::class);
        $hydrator->hydrate(ProgramInterface::HYDRATE_CLASS, $program)->shouldBeCalled()->willReturn($resource);

        $handler = new ProgramsHandler($service->reveal(), $hydrator->reveal());
        $program = current($this->await(Promise::fromObservable(unwrapObservableFromPromise($handler->handle(new ProgramsCommand()))->toArray())));

        self::assertSame($resource, $program);
    }
}
