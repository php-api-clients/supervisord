<?php declare(strict_types=1);

namespace ApiClients\Tests\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\StateCommand;
use ApiClients\Client\Supervisord\CommandBus\Handler\StateHandler;
use ApiClients\Client\Supervisord\Resource\StateInterface;
use ApiClients\Foundation\Hydrator\Hydrator;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use ApiClients\Tools\TestUtilities\TestCase;
use function React\Promise\resolve;

final class StateHandlerTest extends TestCase
{
    public function testCommand()
    {
        $state = [
            'statecode' => 1,
            'statecname' => 'GOOD',
        ];

        $resource = $this->prophesize(StateInterface::class)->reveal();

        $service = $this->prophesize(XmlRpcService::class);
        $service->call('supervisor.getState')->shouldBeCalled()->willReturn(resolve($state));

        $hydrator = $this->prophesize(Hydrator::class);
        $hydrator->hydrate(StateInterface::HYDRATE_CLASS, $state)->shouldBeCalled()->willReturn($resource);

        $handler = new StateHandler($service->reveal(), $hydrator->reveal());
        $result = $this->await($handler->handle(new StateCommand()));

        self::assertSame($resource, $result);
    }
}
