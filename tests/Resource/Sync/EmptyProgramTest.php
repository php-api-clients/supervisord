<?php declare(strict_types=1);

namespace MyVendor\Tests\Client\Supervisord\Resource\Sync;

use ApiClients\Client\Supervisord\Resource\Sync\EmptyProgram;
use ApiClients\Tools\ResourceTestUtilities\AbstractEmptyResourceTest;

final class EmptyProgramTest extends AbstractEmptyResourceTest
{
    public function getSyncAsync(): string
    {
        return 'Sync';
    }

    public function getClass(): string
    {
        return EmptyProgram::class;
    }
}
