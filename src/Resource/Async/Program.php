<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource\Async;

use ApiClients\Client\Supervisord\CommandBus\Command\ProgramCommand;
use ApiClients\Client\Supervisord\Resource\Program as BaseProgram;
use React\Promise\PromiseInterface;

class Program extends BaseProgram
{
    public function refresh(): PromiseInterface
    {
        return $this->handleCommand(new ProgramCommand($this->name));
    }
}
