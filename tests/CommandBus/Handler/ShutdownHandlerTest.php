<?php declare(strict_types=1);

namespace ApiClients\Tests\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ShutdownCommand;
use ApiClients\Client\Supervisord\CommandBus\Handler\ShutdownHandler;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use ApiClients\Tools\TestUtilities\TestCase;
use function React\Promise\resolve;

final class ShutdownHandlerTest extends TestCase
{
    public function testCommand()
    {
        $service = $this->prophesize(XmlRpcService::class);
        $service->call('supervisor.shutdown')->shouldBeCalled()->willReturn(resolve(true));

        $handler = new ShutdownHandler($service->reveal());
        $result = $this->await($handler->handle(new ShutdownCommand()));

        self::assertTrue($result);
    }
}
