<?php

declare(strict_types=1);

namespace pvc\container\defs;

use pvcTests\container\fixture\Bar;
use pvcTests\container\fixture\Baz;
use pvcTests\container\fixture\Foo;
use pvcTests\container\fixture\Quux;


return [
	new Definition(Bar::class),
	new Definition(Baz::class),
	new Definition(Quux::class),

	new Definition(Foo::class)
		->addConstructorArgs(Bar::class, Baz::class, 'some_string'),

	new Definition('FooInitialized', Foo::class)
	->addConstructorArgs(Bar::class, Baz::class, 'some_other_string')
	->addMethodCall('initialize', Quux::class),
];