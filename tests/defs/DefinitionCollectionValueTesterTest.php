<?php

namespace pvcTests\container\defs;

use pvc\container\defs\DefinitionCollectionValueTester;
use PHPUnit\Framework\TestCase;
use pvc\interfaces\container\DefinitionInterface;

class DefinitionCollectionValueTesterTest extends TestCase
{
	protected DefinitionCollectionValueTester $valueTester;

	public function setUp(): void
	{
		$this->valueTester = new DefinitionCollectionValueTester();
	}

	/**
	 * testValueTester
	 * @return void
	 * @covers \pvc\container\defs\DefinitionCollectionValueTester::testValue
	 */
	public function testValueTester(): void
	{
		$def = $this->createMock(DefinitionInterface::class);
		self::assertTrue($this->valueTester->testValue($def));
		self::assertFalse($this->valueTester->testValue('some_string'));
	}
}
