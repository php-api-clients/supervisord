<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource\Async;

use ApiClients\Client\Supervisord\CommandBus\Command\Program\StartCommand;
use ApiClients\Client\Supervisord\CommandBus\Command\Program\StopCommand;
use ApiClients\Client\Supervisord\CommandBus\Command\ProgramCommand;
use ApiClients\Client\Supervisord\Resource\Program as BaseProgram;
use React\Promise\PromiseInterface;

class Program extends BaseProgram
{
    public function refresh(): PromiseInterface
    {
        return $this->handleCommand(new ProgramCommand($this->name));
    }

    /**
     * Reason behind the enable/disable names is that start is in
     * use by an property.
     *
     * @return PromiseInterface
     */
    public function enable(): PromiseInterface
    {
        return $this->handleCommand(new StartCommand($this->name));
    }

    public function disable(): PromiseInterface
    {
        return $this->handleCommand(new StopCommand($this->name));
    }

    public function restart(): PromiseInterface
    {
        return $this->disable()->then(function () {
            return $this->enable();
        })->then(function () {
            return $this->refresh();
        });
    }
}
