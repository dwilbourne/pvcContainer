<?php

declare (strict_types=1);

use pvc\msg\DomainCatalogFileLoaderPHP;

use function DI\create;
use function DI\get;

return [
	'ParserMessagesPath' => 'I:\www\pvcParser\messages',
	'ParserMessages' => create(DomainCatalogFileLoaderPHP::class)->constructor(get('ParserMessagesPath')),

	'ValidatorMessagesPath' => 'I:\www\pvcValidator\messages',
	'ValidatorMessages' => create(DomainCatalogFileLoaderPHP::class)->constructor(get('ValidatorMessagesPath')),
];

