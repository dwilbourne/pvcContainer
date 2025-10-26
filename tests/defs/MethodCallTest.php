<?php

namespace pvcTests\container\defs;

use pvc\container\defs\MethodCall;
use PHPUnit\Framework\TestCase;
use pvc\interfaces\container\DefinitionInterface;

class MethodCallTest extends TestCase
{
	protected MethodCall $methodCall;

	protected string $methodName = 'someName';

	/**
	 * @var array<mixed>
	 */
	protected array $args = [5, 'someValue'];

	protected function setUp(): void
	{
		$this->methodCall = new MethodCall($this->methodName, ... $this->args);
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
		$this->assertEquals($this->methodName, $this->methodCall->getMethodName());
	}

	/**
	 * testGetArguments
	 * @return void
	 * @covers \pvc\container\defs\MethodCall::getArguments
	 */
	public function testGetArguments(): void
	{
		$this->assertEquals($this->args, $this->methodCall->getArguments());
	}
}
