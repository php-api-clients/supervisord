<?php declare(strict_types=1);

namespace MyVendor\Tests\Client\Supervisord\Resource\Async;

use ApiClients\Client\Supervisord\Resource\Async\EmptyProgram;
use ApiClients\Tools\ResourceTestUtilities\AbstractEmptyResourceTest;

final class EmptyProgramTest extends AbstractEmptyResourceTest
{
    public function getSyncAsync(): string
    {
        return 'Async';
    }

    public function getClass(): string
    {
        return EmptyProgram::class;
    }
}
