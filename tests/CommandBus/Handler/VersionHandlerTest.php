<?php declare(strict_types=1);

namespace ApiClients\Tests\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\VersionCommand;
use ApiClients\Client\Supervisord\CommandBus\Handler\VersionHandler;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use ApiClients\Tools\TestUtilities\TestCase;
use function React\Promise\resolve;

final class VersionHandlerTest extends TestCase
{
    public function testCommand()
    {
        $service = $this->prophesize(XmlRpcService::class);
        $service->call('supervisor.getSupervisorVersion')->shouldBeCalled()->willReturn(resolve('3.3.3'));

        $handler = new VersionHandler($service->reveal());
        $version = $this->await($handler->handle(new VersionCommand()));

        self::assertSame('3.3.3', $version);
    }
}
