<?php

namespace pvcTests\container\defs;

use pvc\container\defs\DefCollectionBuilder;
use pvc\container\defs\Definition;
use pvc\container\defs\DefinitionFactory;
use PHPUnit\Framework\TestCase;

/**
 * @phpstan-import-type DefArray from DefCollectionBuilder
 */
class DefinitionFactoryTest extends TestCase
{
	protected DefinitionFactory $factory;

	/**
	 * @var DefArray
	 */
	protected array $defArray;

	protected string $alias = 'alias';
	protected string $classString = 'someClass';

	/**
	 * @var array<string>
	 */
	protected array $args = ['foo', 'bar'];

	public function setUp(): void
	{
		$this->factory = new DefinitionFactory();
		$this->defArray = ['alias' => $this->alias, 'class-string' => $this->classString, 'args' => $this->args];
	}

	/**
	 * testMakeDefinition
	 * @return void
	 * @covers \pvc\container\defs\DefinitionFactory::makeDefinition
	 */
	public function testMakeDefinition(): void
	{
		$def = $this->factory->makeDefinition($this->defArray);
		self::assertInstanceOf(Definition::class, $def);
	}
}
