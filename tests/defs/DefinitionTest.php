<?php

namespace pvcTests\container\defs;

use pvc\container\defs\Definition;
use PHPUnit\Framework\TestCase;
use pvc\container\defs\MethodCall;
use pvc\interfaces\container\DefinitionInterface;

use function PHPUnit\Framework\assertInstanceOf;

class DefinitionTest extends TestCase
{
	protected string $alias = 'alias';
	protected string $classString = 'a_class_string';

	/**
	 * @var array<mixed>
	 */
	protected array $constructorArgs = ['foo', 'bar'];


	protected Definition $definition;

	/**
	 * testConstructWithJustClassString
	 *
	 * @return void
	 * @covers \pvc\container\defs\Definition::__construct
	 * @covers \pvc\container\defs\Definition::getAlias
	 * @covers \pvc\container\defs\Definition::getClassString
	 * @covers \pvc\container\defs\Definition::getConstructorArgs
	 * @covers \pvc\container\defs\Definition::getMethodCalls
	 */
	public function testConstructWithJustClassString(): void
	{
		$def = new Definition($this->classString);
		self::assertInstanceOf(Definition::class, $def);

		self::assertEquals($this->classString, $def->getAlias());
		self::assertEquals($this->classString, $def->getClassString());
		self::assertEquals([], $def->getConstructorArgs());
		self::assertEquals([], $def->getMethodCalls());
	}

	/**
	 * testConstructWithAlias
	 * @return void
	 * @covers \pvc\container\defs\Definition::__construct
	 */
	public function testConstructWithAlias(): void
	{
		$def = new Definition($this->alias, $this->classString);
		self::assertInstanceOf(Definition::class, $def);
		self::assertEquals($this->alias, $def->getAlias());
		self::assertEquals($this->classString, $def->getClassString());
	}

	/**
	 * testWithConstructorArgs
	 * @return void
	 * @covers \pvc\container\defs\Definition::__construct
	 * @covers \pvc\container\defs\Definition::addConstructorArgs
	 */
	public function testWithConstructorArgs(): void
	{
		$def = new Definition($this->alias, $this->classString)
			->addConstructorArgs(... $this->constructorArgs);

		self::assertInstanceOf(Definition::class, $def);
		self::assertEquals($this->alias, $def->getAlias());
		self::assertEquals($this->classString, $def->getClassString());
		self::assertEquals($this->constructorArgs, $def->getConstructorArgs());
	}

	/**
	 * testWithMethodCalls
	 * @return void
	 * @covers \pvc\container\defs\Definition::__construct
	 * @covers \pvc\container\defs\Definition::addMethodCall
	 */
	public function testWithMethodCalls(): void
	{
		$methodA = 'initialize';
		$methodB = 'setProperty';
		$methodBArgs = ['some other value', 4];


		$def = new Definition($this->alias, $this->classString)
			->addConstructorArgs(... $this->constructorArgs)
			->addMethodCall($methodA)
			->addMethodCall($methodB, ... $methodBArgs);


		foreach($def->getMethodCalls() as $methodCall) {
			assertInstanceOf(MethodCall::class, $methodCall);
		}
	}
}
