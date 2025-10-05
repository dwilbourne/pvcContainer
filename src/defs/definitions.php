<?php

declare(strict_types=1);

namespace pvc\container\defs;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Psr7\Query as GuzzleQueryString;
use GuzzleHttp\Psr7\Request as GuzzleRequest;
use GuzzleHttp\Psr7\Response as GuzzleResponse;
use GuzzleHttp\Psr7\Uri as GuzzleUri;
use Monolog\Logger as MonologLogger;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;
use Psr\Log\LoggerInterface;
use pvc\interfaces\http\QueryStringInterface;


return [
	['alias' => LoggerInterface::class, 'class-string' => MonologLogger::class],
	['alias' => ClientInterface::class, 'class-string' => GuzzleClient::class],
	['alias' => RequestInterface::class, 'class-string' => GuzzleRequest::class],
	['alias' => ResponseInterface::class, 'class-string' => GuzzleResponse::class],
	['alias' => UriInterface::class, 'class-string' => GuzzleUri::class],
	['alias' => QueryStringInterface::class, 'class-string' => GuzzleQueryString::class],
];