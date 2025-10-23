<?php

namespace pvcTests\container\defs;

use pvc\container\defs\MethodCall;
use PHPUnit\Framework\TestCase;
use pvc\interfaces\container\DefinitionInterface;

/**
 * @phpstan-import-type MethodCallArray from DefinitionInterface
 */
class MethodCallTest extends TestCase
{
	protected MethodCall $methodCall;

	/**
	 * @var MethodCallArray
	 */
	protected array $testArray = [
		'methodName' => 'someName',
		'arguments' => [5, 'someValue'],
	];

	protected function setUp(): void
	{
		$this->methodCall = new MethodCall($this->testArray);
	}

	/**
	 * testConstruct
	 * @return void
	 * @covers \pvc\container\defs\MethodCall::__construct
	 */
	public function testConstruct(): void
	{
		$this->assertInstanceOf(MethodCall::class, $this->methodCall);
	}

	/**
	 * testGetMethodName
	 * @return void
	 * @covers \pvc\container\defs\MethodCall::getMethodName
	 */
	public function testGetMethodName(): void
	{
		$this->assertEquals($this->testArray['methodName'], $this->methodCall->getMethodName());
	}

	/**
	 * testGetArguments
	 * @return void
	 * @covers \pvc\container\defs\MethodCall::getArguments
	 */
	public function testGetArguments(): void
	{
		assert(isset($this->testArray['arguments']));
		$this->assertEquals($this->testArray['arguments'], $this->methodCall->getArguments());
	}
}
