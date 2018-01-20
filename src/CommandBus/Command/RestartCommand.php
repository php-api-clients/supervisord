<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Command;

use WyriHaximus\Tactician\CommandHandler\Annotations\Handler;

/**
 * @Handler("ApiClients\Client\Supervisord\CommandBus\Handler\RestartHandler")
 */
final class RestartCommand
{
}
