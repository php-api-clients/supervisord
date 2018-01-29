<?php declare(strict_types=1);

namespace ApiClients\Tests\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ProgramCommand;
use ApiClients\Client\Supervisord\CommandBus\Handler\ProgramHandler;
use ApiClients\Client\Supervisord\Resource\ProgramInterface;
use ApiClients\Client\Supervisord\Resource\StateInterface;
use ApiClients\Foundation\Hydrator\Hydrator;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use ApiClients\Tools\TestUtilities\TestCase;
use function React\Promise\resolve;

final class ProgramHandlerTest extends TestCase
{
    public function testCommand()
    {
        $program = [
            'name' => 'ping',
        ];

        $resource = $this->prophesize(StateInterface::class)->reveal();

        $service = $this->prophesize(XmlRpcService::class);
        $service->call('supervisor.getProcessInfo', ['ping'])->shouldBeCalled()->willReturn(resolve($program));

        $hydrator = $this->prophesize(Hydrator::class);
        $hydrator->hydrate(ProgramInterface::HYDRATE_CLASS, $program)->shouldBeCalled()->willReturn($resource);

        $handler = new ProgramHandler($service->reveal(), $hydrator->reveal());
        $result = $this->await($handler->handle(new ProgramCommand('ping')));

        self::assertSame($resource, $result);
    }
}
