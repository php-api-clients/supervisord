<?php declare(strict_types=1);

namespace ApiClients\Tests\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\APIVersionCommand;
use ApiClients\Client\Supervisord\CommandBus\Handler\APIVersionHandler;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use ApiClients\Tools\TestUtilities\TestCase;
use function React\Promise\resolve;

final class APIVersionHandlerTest extends TestCase
{
    public function testCommand()
    {
        $service = $this->prophesize(XmlRpcService::class);
        $service->call('supervisor.getAPIVersion')->shouldBeCalled()->willReturn(resolve('1.2.3'));

        $handler = new APIVersionHandler($service->reveal());
        $version = $this->await($handler->handle(new APIVersionCommand()));

        self::assertSame('1.2.3', $version);
    }
}
