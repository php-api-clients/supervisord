<?php declare(strict_types=1);

namespace ApiClients\Tests\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\RestartCommand;
use ApiClients\Client\Supervisord\CommandBus\Handler\RestartHandler;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use ApiClients\Tools\TestUtilities\TestCase;
use function React\Promise\resolve;

final class RestartHandlerTest extends TestCase
{
    public function testCommand()
    {
        $service = $this->prophesize(XmlRpcService::class);
        $service->call('supervisor.restart')->shouldBeCalled()->willReturn(resolve(true));

        $handler = new RestartHandler($service->reveal());
        $result = $this->await($handler->handle(new RestartCommand()));

        self::assertTrue($result);
    }
}
