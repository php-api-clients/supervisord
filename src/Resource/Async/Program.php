<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource\Async;

use ApiClients\Client\Supervisord\Resource\Program as BaseProgram;

class Program extends BaseProgram
{
    public function refresh(): Program
    {
        throw new \Exception('TODO: create refresh method!');
    }
}
