<?php declare(strict_types=1);

namespace MyVendor\Tests\Client\Supervisord\Resource\Async;

use ApiClients\Client\Supervisord\Resource\Async\EmptyState;
use ApiClients\Tools\ResourceTestUtilities\AbstractEmptyResourceTest;

final class EmptyStateTest extends AbstractEmptyResourceTest
{
    public function getSyncAsync(): string
    {
        return 'Async';
    }

    public function getClass(): string
    {
        return EmptyState::class;
    }
}
