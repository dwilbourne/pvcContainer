<?php

namespace pvcTests\container\defs;

use pvc\container\defs\Definition;
use pvc\container\defs\DefinitionFactory;
use PHPUnit\Framework\TestCase;
use pvc\interfaces\container\DefinitionInterface;
use pvcTests\container\fixture\Bar;
use pvcTests\container\fixture\Baz;
use pvcTests\container\fixture\Foo;
use pvcTests\container\fixture\Quux;

/**
 * @phpstan-import-type DefinitionArray from DefinitionInterface
 */
class DefinitionFactoryTest extends TestCase
{
	protected DefinitionFactory $factory;

	/**
	 * @var DefinitionArray
	 */
	protected array $definition = 	[
		'alias' => 'FooInitialized',
		'resolvableString' => Foo::class,
		'constructorArgs'  => [Bar::class, Baz::class],
		'methodCalls'      => [['methodName' => 'initialize', 'arguments' => [Quux::class]]],
	];

	public function setUp(): void
	{
		$this->factory = new DefinitionFactory();
	}

	/**
	 * testMakeDefinition
	 * @return void
	 * @covers \pvc\container\defs\DefinitionFactory::makeDefinition
	 */
	public function testMakeDefinition(): void
	{
		$def = $this->factory->makeDefinition($this->definition);
		self::assertInstanceOf(Definition::class, $def);
	}
}
