<?php declare(strict_types=1);

namespace MyVendor\Tests\Client\Supervisord\Resource\Sync;

use ApiClients\Client\Supervisord\Resource\Sync\EmptyState;
use ApiClients\Tools\ResourceTestUtilities\AbstractEmptyResourceTest;

final class EmptyStateTest extends AbstractEmptyResourceTest
{
    public function getSyncAsync(): string
    {
        return 'Sync';
    }

    public function getClass(): string
    {
        return EmptyState::class;
    }
}
