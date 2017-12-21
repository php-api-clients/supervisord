<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource\Sync;

use ApiClients\Client\Supervisord\Resource\Program as BaseProgram;
use ApiClients\Client\Supervisord\Resource\ProgramInterface;
use ApiClients\Foundation\Hydrator\CommandBus\Command\BuildAsyncFromSyncCommand;

class Program extends BaseProgram
{
    public function refresh(): Program
    {
        return $this->wait($this->handleCommand(new BuildAsyncFromSyncCommand(self::HYDRATE_CLASS, $this))->then(function (ProgramInterface $program) {
            return $program->refresh();
        }));
    }

    public function enable(): bool
    {
        return $this->wait($this->handleCommand(new BuildAsyncFromSyncCommand(self::HYDRATE_CLASS, $this))->then(function (ProgramInterface $program) {
            return $program->enable();
        }));
    }

    public function disable(): bool
    {
        return $this->wait($this->handleCommand(new BuildAsyncFromSyncCommand(self::HYDRATE_CLASS, $this))->then(function (ProgramInterface $program) {
            return $program->disable();
        }));
    }

    public function restart(): Program
    {
        return $this->wait($this->handleCommand(new BuildAsyncFromSyncCommand(self::HYDRATE_CLASS, $this))->then(function (ProgramInterface $program) {
            return $program->restart();
        }));
    }
}
