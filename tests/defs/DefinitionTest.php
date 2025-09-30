<?php

namespace pvcTests\container\defs;

use pvc\container\defs\Definition;
use PHPUnit\Framework\TestCase;

class DefinitionTest extends TestCase
{
	protected string $alias = 'alias';
	protected string $classString = 'someClass';

	/**
	 * @var array<string>
	 */
	protected array $args = ['foo', 'bar'];

	protected Definition $definition;

	/**
	 * testConstructWithNoArgs
	 * @return void
	 * @covers \pvc\container\defs\Definition::__construct
	 */
	public function testConstructWithNoArgs(): void
	{
		$def = new Definition($this->alias, $this->classString);
		self::assertEquals($this->alias, $def->alias);
		self::assertEquals($this->classString, $def->classString);
		self::assertEquals([], $def->args);
	}

	/**
	 * testConstructWithArgs
	 * @return void
	 * @covers \pvc\container\defs\Definition::__construct
	 */
	public function testConstructWithArgs(): void
	{
		$def = new Definition($this->alias, $this->classString, $this->args);
		self::assertEquals($this->args, $def->args);
	}

}
