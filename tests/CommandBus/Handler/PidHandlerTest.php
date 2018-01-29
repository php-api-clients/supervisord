<?php declare(strict_types=1);

namespace ApiClients\Tests\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\PidCommand;
use ApiClients\Client\Supervisord\CommandBus\Handler\PidHandler;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use ApiClients\Tools\TestUtilities\TestCase;
use function React\Promise\resolve;

final class PidHandlerTest extends TestCase
{
    public function testCommand()
    {
        $service = $this->prophesize(XmlRpcService::class);
        $service->call('supervisor.getPID')->shouldBeCalled()->willReturn(resolve(123456));

        $handler = new PidHandler($service->reveal());
        $pid = $this->await($handler->handle(new PidCommand()));

        self::assertSame(123456, $pid);
    }
}
