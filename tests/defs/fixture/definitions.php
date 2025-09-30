<?php

declare(strict_types=1);

namespace pvc\container\defs;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Monolog\Logger;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;


return [
	['alias' => LoggerInterface::class, 'class-string' => Logger::class],
	['alias' => ClientInterface::class, 'class-string' => Client::class],
	['alias' => RequestInterface::class, 'class-string' => Request::class],
	['alias' => ResponseInterface::class, 'class-string' => Response::class],
];