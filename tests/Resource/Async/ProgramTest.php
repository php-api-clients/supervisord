<?php declare(strict_types=1);

namespace MyVendor\Tests\Client\Supervisord\Resource\Async;

use ApiClients\Client\Supervisord\ApiSettings;
use ApiClients\Client\Supervisord\Resource\Program;
use ApiClients\Tools\ResourceTestUtilities\AbstractResourceTest;

class ProgramTest extends AbstractResourceTest
{
    public function getSyncAsync(): string
    {
        return 'Async';
    }

    public function getClass(): string
    {
        return Program::class;
    }

    public function getNamespace(): string
    {
        return ApiSettings::NAMESPACE;
    }
}
