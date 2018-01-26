<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource\Async;

use ApiClients\Client\Supervisord\Resource\State as BaseState;

class State extends BaseState
{
    public function refresh(): State
    {
        throw new \Exception('TODO: create refresh method!');
    }
}
