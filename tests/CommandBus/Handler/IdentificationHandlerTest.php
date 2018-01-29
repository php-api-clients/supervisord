<?php declare(strict_types=1);

namespace ApiClients\Tests\Supervisord\CommandBus\Handler;

use ApiClients\Client\Supervisord\CommandBus\Command\IdentificationCommand;
use ApiClients\Client\Supervisord\CommandBus\Handler\IdentificationHandler;
use ApiClients\Tools\Services\XmlRpc\XmlRpcService;
use ApiClients\Tools\TestUtilities\TestCase;
use function React\Promise\resolve;

final class IdentificationHandlerTest extends TestCase
{
    public function testCommand()
    {
        $service = $this->prophesize(XmlRpcService::class);
        $service->call('supervisor.getIdentification')->shouldBeCalled()->willReturn(resolve('supervisor'));

        $handler = new IdentificationHandler($service->reveal());
        $version = $this->await($handler->handle(new IdentificationCommand()));

        self::assertSame('supervisor', $version);
    }
}
