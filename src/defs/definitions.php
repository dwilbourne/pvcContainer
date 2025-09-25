<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use Monolog\Logger;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;


return [
	[LoggerInterface::class, Logger::class],
	[ClientInterface::class, Client::class],
	[RequestInterface::class, Request::class],
	[ResponseInterface::class, Response::class],
];