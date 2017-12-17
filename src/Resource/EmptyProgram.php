<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource;

use ApiClients\Foundation\Resource\EmptyResourceInterface;

abstract class EmptyProgram implements ProgramInterface, EmptyResourceInterface
{
    /**
     * @return string
     */
    public function description(): string
    {
        return null;
    }

    /**
     * @return int
     */
    public function pid(): int
    {
        return null;
    }

    /**
     * @return string
     */
    public function stderrLogfile(): string
    {
        return null;
    }

    /**
     * @return int
     */
    public function stop(): int
    {
        return null;
    }

    /**
     * @return string
     */
    public function logfile(): string
    {
        return null;
    }

    /**
     * @return int
     */
    public function exitstatus(): int
    {
        return null;
    }

    /**
     * @return string
     */
    public function spawnerr(): string
    {
        return null;
    }

    /**
     * @return int
     */
    public function now(): int
    {
        return null;
    }

    /**
     * @return string
     */
    public function group(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return null;
    }

    /**
     * @return string
     */
    public function statename(): string
    {
        return null;
    }

    /**
     * @return int
     */
    public function start(): int
    {
        return null;
    }

    /**
     * @return int
     */
    public function state(): int
    {
        return null;
    }

    /**
     * @return string
     */
    public function stdoutLogfile(): string
    {
        return null;
    }
}
