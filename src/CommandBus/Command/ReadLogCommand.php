<?php

declare(strict_types=1);

namespace ApiClients\Client\Supervisord\CommandBus\Command;

use WyriHaximus\Tactician\CommandHandler\Annotations\Handler;

/**
 * @Handler("ApiClients\Client\Supervisord\CommandBus\Handler\ReadLogHandler")
 */
final class ReadLogCommand
{
    /**
     * @var int
     */
    private $offset;

    /**
     * @var int
     */
    private $length;

    /**
     * @param int $offset
     * @param int $length
     */
    public function __construct(int $offset, int $length)
    {
        $this->offset = $offset;
        $this->length = $length;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }

    /**
     * @return int
     */
    public function getLength(): int
    {
        return $this->length;
    }
}
