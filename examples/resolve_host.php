<?php declare(strict_types=1);
use ApiClients\Client\Github\Authentication\Anonymous;
use ApiClients\Client\Github\Authentication\Token;
use ApiClients\Client\Github\RateLimitState;

$keyFile = dirname(__DIR__) . DIRECTORY_SEPARATOR . 'host.php';

if (!file_exists($keyFile)) {
    echo 'No host file find, copy host.sample.php to host.php and add your supervisor host to it', PHP_EOL;
    die();
}

return require $keyFile;
