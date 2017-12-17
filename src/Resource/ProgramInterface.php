<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource;

use ApiClients\Foundation\Resource\ResourceInterface;

interface ProgramInterface extends ResourceInterface
{
    const HYDRATE_CLASS = 'Program';

    /**
     * @return string
     */
    public function group(): string;

    /**
     * @return string
     */
    public function name(): string;

    /**
     * @return int
     */
    public function pid(): int;

    /**
     * @return string
     */
    public function description(): string;

    /**
     * @return int
     */
    public function state(): int;

    /**
     * @return string
     */
    public function statename(): string;

    /**
     * @return int
     */
    public function now(): int;

    /**
     * @return int
     */
    public function start(): int;

    /**
     * @return int
     */
    public function stop(): int;

    /**
     * @return string
     */
    public function spawnerr(): string;

    /**
     * @return int
     */
    public function exitstatus(): int;

    /**
     * @return string
     */
    public function logfile(): string;

    /**
     * @return string
     */
    public function stdoutLogfile(): string;

    /**
     * @return string
     */
    public function stderrLogfile(): string;
}
