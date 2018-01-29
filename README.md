# Supervisord HTTP API Client for PHP 7

[![Build Status](https://travis-ci.org/php-api-clients/supervisord.svg?branch=master)](https://travis-ci.org/php-api-clients/supervisord)
[![Latest Stable Version](https://poser.pugx.org/api-clients/supervisord/v/stable.png)](https://packagist.org/packages/api-clients/supervisord)
[![Total Downloads](https://poser.pugx.org/api-clients/supervisord/downloads.png)](https://packagist.org/packages/api-clients/supervisord)
[![Code Coverage](https://scrutinizer-ci.com/g/php-api-clients/supervisord/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/php-api-clients/supervisord/?branch=master)
[![License](https://poser.pugx.org/api-clients/supervisord/license.png)](https://packagist.org/packages/api-clients/supervisord)
[![PHP 7 ready](http://php7ready.timesplinter.ch/php-api-clients/supervisord/badge.svg)](https://travis-ci.org/php-api-clients/supervisord)

# Install

To install via [Composer](http://getcomposer.org/), use the command below, it will automatically detect the latest version and bind it with `^`.

```
composer require api-clients/supervisord
```

# Usage

The client needs two things, an IP + port to connect to, and the ReactPHP event loop. Once you created the client you can call the `state` method to get supervisord's current state.

```php
use ApiClients\Client\Supervisord\AsyncClient;
use ApiClients\Client\Supervisord\Resource\StateInterface;
use React\EventLoop\Factory;
use function ApiClients\Foundation\resource_pretty_print;

$loop = Factory::create();
$client = AsyncClient::create('127.0.0.1:9005', $loop); // My supvervisor runs at 127.0.0.1:9005 changes for your HTTP IP + port

$client->state()->done(function (StateInterface $state) {
    resource_pretty_print($state);
});

$loop->run();

```

For more examples check the [examples](examples) directory.

# License

The MIT License (MIT)

Copyright (c) 2017 Cees-Jan Kiewiet

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
