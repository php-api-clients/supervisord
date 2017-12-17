<?php declare(strict_types=1);

namespace ApiClients\Client\Supervisord\Resource;

use ApiClients\Foundation\Hydrator\Annotation\EmptyResource;
use ApiClients\Foundation\Resource\AbstractResource;

/**
 * @EmptyResource("EmptyProgram")
 */
abstract class Program extends AbstractResource implements ProgramInterface
{
    /**
     * @var string
     */
    protected $group;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $pid;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var int
     */
    protected $state;

    /**
     * @var string
     */
    protected $statename;

    /**
     * @var int
     */
    protected $now;

    /**
     * @var int
     */
    protected $start;

    /**
     * @var int
     */
    protected $stop;

    /**
     * @var string
     */
    protected $spawnerr;

    /**
     * @var int
     */
    protected $exitstatus;

    /**
     * @var string
     */
    protected $logfile;

    /**
     * @var string
     */
    protected $stdout_logfile;

    /**
     * @var string
     */
    protected $stderr_logfile;

    /**
     * @return string
     */
    public function group(): string
    {
        return $this->group;
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function pid(): int
    {
        return $this->pid;
    }

    /**
     * @return string
     */
    public function description(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function state(): int
    {
        return $this->state;
    }

    /**
     * @return string
     */
    public function statename(): string
    {
        return $this->statename;
    }

    /**
     * @return int
     */
    public function now(): int
    {
        return $this->now;
    }

    /**
     * @return int
     */
    public function start(): int
    {
        return $this->start;
    }

    /**
     * @return int
     */
    public function stop(): int
    {
        return $this->stop;
    }

    /**
     * @return string
     */
    public function spawnerr(): string
    {
        return $this->spawnerr;
    }

    /**
     * @return int
     */
    public function exitstatus(): int
    {
        return $this->exitstatus;
    }

    /**
     * @return string
     */
    public function logfile(): string
    {
        return $this->logfile;
    }

    /**
     * @return string
     */
    public function stdoutLogfile(): string
    {
        return $this->stdout_logfile;
    }

    /**
     * @return string
     */
    public function stderrLogfile(): string
    {
        return $this->stderr_logfile;
    }
}
