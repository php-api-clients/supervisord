<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Command\Program;

use WyriHaximus\Tactician\CommandHandler\Annotations\Handler;

/**
 * @Handler("ApiClients\Client\Supervisord\CommandBus\Handler\Program\StopHandler")
 */
final class StopCommand
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
