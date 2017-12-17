<?php

declare(strict_types=1);

namespace MyVendor\Tests\Client\SupervisordApiClients\Tests\Skeleton;

use ApiClients\Client\Supervisord\ApiSettings;
use ApiClients\Foundation\Hydrator\Options as HydratorOptions;
use ApiClients\Foundation\Options as FoundationOptions;
use ApiClients\Tools\TestUtilities\TestCase;

final class ApiSettingsTest extends TestCase
{
    public function testGetOptions()
    {
        $options = ApiSettings::getOptions('127.0.0.1:9005', [], 'Suffix');
        self::assertTrue(isset($options[FoundationOptions::HYDRATOR_OPTIONS][HydratorOptions::NAMESPACE_SUFFIX]));
        self::assertSame('Suffix', $options[FoundationOptions::HYDRATOR_OPTIONS][HydratorOptions::NAMESPACE_SUFFIX]);
    }
}
