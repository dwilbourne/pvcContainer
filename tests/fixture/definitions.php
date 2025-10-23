<?php

declare(strict_types=1);

namespace pvc\container\defs;

use pvcTests\container\fixture\Bar;
use pvcTests\container\fixture\Baz;
use pvcTests\container\fixture\Foo;
use pvcTests\container\fixture\Quux;


return [
	[
		'resolvableString' => Bar::class,
	],
	[
		'resolvableString' => Baz::class,
	],
	[
		'resolvableString' => Quux::class,
	],
	[
		'resolvableString' => Foo::class,
		'constructorArgs'  => [Bar::class, Baz::class, 'some_string'],
	],
	[
		'alias' => 'FooInitialized',
		'resolvableString' => Foo::class,
		'constructorArgs'  => [Bar::class, Baz::class, 'some_other_string'],
		'methodCalls'      => [['methodName' => 'initialize', 'arguments' => [Quux::class]]],
	],
];