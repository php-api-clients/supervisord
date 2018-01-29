<?php declare(strict_types=1);

namespace ApiClients\Tests\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ReadLogCommand;
use ApiClients\Client\Supervisord\CommandBus\Handler\ReadLogHandler;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use ApiClients\Tools\TestUtilities\TestCase;
use function React\Promise\resolve;

final class ReadLogHandlerTest extends TestCase
{
    public function testCommand()
    {
        $service = $this->prophesize(XmlRpcService::class);
        $service->call('supervisor.readLog', [1, 2])->shouldBeCalled()->willReturn(resolve('foo.bar'));

        $handler = new ReadLogHandler($service->reveal());
        $log = $this->await($handler->handle(new ReadLogCommand(1, 2)));

        self::assertSame('foo.bar', $log);
    }
}
