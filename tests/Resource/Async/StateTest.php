<?php declare(strict_types=1);

namespace MyVendor\Tests\Client\Supervisord\Resource\Async;

use ApiClients\Client\Supervisord\ApiSettings;
use ApiClients\Client\Supervisord\Resource\State;
use ApiClients\Tools\ResourceTestUtilities\AbstractResourceTest;

class StateTest extends AbstractResourceTest
{
    public function getSyncAsync(): string
    {
        return 'Async';
    }

    public function getClass(): string
    {
        return State::class;
    }

    public function getNamespace(): string
    {
        return ApiSettings::NAMESPACE;
    }
}
