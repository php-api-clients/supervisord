<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource\Sync;

use ApiClients\Client\Supervisord\Resource\State as BaseState;
use ApiClients\Client\Supervisord\Resource\StateInterface;
use ApiClients\Foundation\Hydrator\CommandBus\Command\BuildAsyncFromSyncCommand;

class State extends BaseState
{
    public function refresh(): State
    {
        return $this->wait($this->handleCommand(new BuildAsyncFromSyncCommand(self::HYDRATE_CLASS, $this))->then(function (StateInterface $state) {
            return $state->refresh();
        }));
    }
}
