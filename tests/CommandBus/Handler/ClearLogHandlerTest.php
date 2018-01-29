<?php declare(strict_types=1);

namespace ApiClients\Tests\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\ClearLogCommand;
use ApiClients\Client\Supervisord\CommandBus\Handler\ClearLogHandler;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use ApiClients\Tools\TestUtilities\TestCase;
use function React\Promise\resolve;

final class ClearLogHandlerTest extends TestCase
{
    public function testCommand()
    {
        $service = $this->prophesize(XmlRpcService::class);
        $service->call('supervisor.clearLog')->shouldBeCalled()->willReturn(resolve(true));

        $handler = new ClearLogHandler($service->reveal());
        $result = $this->await($handler->handle(new ClearLogCommand()));

        self::assertTrue($result);
    }
}
