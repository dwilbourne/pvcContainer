<?php

namespace pvcTests\container\defs;

use pvc\container\defs\Definition;
use PHPUnit\Framework\TestCase;
use pvc\container\defs\MethodCall;
use pvc\interfaces\container\DefinitionInterface;

use function PHPUnit\Framework\assertInstanceOf;

/**
 * @phpstan-import-type Args from DefinitionInterface
 * @phpstan-import-type DefinitionArray from DefinitionInterface
 * @phpstan-import-type MethodCallArray from DefinitionInterface
 */
class DefinitionTest extends TestCase
{
	/**
	 * @var array<MethodCallArray>
	 */
	protected array $methodCalls = [
		['methodName' => 'initialize'],
		['methodName' => 'setProperty', 'arguments' => ['some other value']],
	];

	protected string $alias = 'alias';
	protected string $resolvableString = 'someClass';

	/**
	 * @var Args
	 */
	protected array $constructorArgs = ['foo', 'bar'];


	/**
	 * @var DefinitionArray
	 */
	protected array $definitionArray;

	protected Definition $definition;

	/**
	 * testConstructWithJustResolvableString
	 * @return void
	 * @covers \pvc\container\defs\Definition::__construct
	 * @covers \pvc\container\defs\Definition::getAlias
	 * @covers \pvc\container\defs\Definition::getResolvableString
	 * @covers \pvc\container\defs\Definition::getConstructorArgs
	 * @covers \pvc\container\defs\Definition::getMethodCalls
	 */
	public function testConstructWithJustResolvableString(): void
	{
		$this->definitionArray['resolvableString'] = $this->resolvableString;
		$def = new Definition($this->definitionArray);
		self::assertInstanceOf(Definition::class, $def);

		self::assertEquals($this->resolvableString, $def->getAlias());
		self::assertEquals($this->resolvableString, $def->getResolvableString());
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
		$this->definitionArray['alias'] = $this->alias;
		$this->definitionArray['resolvableString'] = $this->resolvableString;
		$def = new Definition($this->definitionArray);
		self::assertInstanceOf(Definition::class, $def);
		self::assertEquals($this->alias, $def->getAlias());
		self::assertEquals($this->resolvableString, $def->getResolvableString());
	}

	/**
	 * testWithConstructorArgs
	 * @return void
	 * @covers \pvc\container\defs\Definition::__construct
	 */
	public function testWithConstructorArgs(): void
	{
		$this->definitionArray['alias'] = $this->alias;
		$this->definitionArray['resolvableString'] = $this->resolvableString;
		$this->definitionArray['constructorArgs'] = $this->constructorArgs;
		$def = new Definition($this->definitionArray);
		self::assertInstanceOf(Definition::class, $def);
		self::assertEquals($this->alias, $def->getAlias());
		self::assertEquals($this->resolvableString, $def->getResolvableString());
		self::assertEquals($this->constructorArgs, $def->getConstructorArgs());
	}

	/**
	 * testWithMethodCalls
	 * @return void
	 * @covers \pvc\container\defs\Definition::__construct
	 */
	public function testWithMethodCalls(): void
	{
		$this->definitionArray['alias'] = $this->alias;
		$this->definitionArray['resolvableString'] = $this->resolvableString;
		$this->definitionArray['methodCalls'] = $this->methodCalls;
		$def = new Definition($this->definitionArray);

		foreach($def->getMethodCalls() as $methodCall) {
			assertInstanceOf(MethodCall::class, $methodCall);
		}
	}
}
