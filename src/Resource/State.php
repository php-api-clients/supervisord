<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource;

use ApiClients\Foundation\Hydrator\Annotation\EmptyResource;
use ApiClients\Foundation\Resource\AbstractResource;

/**
 * @EmptyResource("EmptyState")
 */
abstract class State extends AbstractResource implements StateInterface
{
    /**
     * @var int
     */
    protected $statecode;

    /**
     * @var string
     */
    protected $statename;

    /**
     * @return int
     */
    public function statecode(): int
    {
        return $this->statecode;
    }

    /**
     * @return string
     */
    public function statename(): string
    {
        return $this->statename;
    }
}
