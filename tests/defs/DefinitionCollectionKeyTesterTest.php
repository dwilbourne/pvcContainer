<?php

namespace pvcTests\container\defs;

use pvc\container\defs\DefinitionCollectionKeyTester;
use PHPUnit\Framework\TestCase;

class DefinitionCollectionKeyTesterTest extends TestCase
{
	protected DefinitionCollectionKeyTester $keyTester;

	public function setUp(): void
	{
		$this->keyTester = new DefinitionCollectionKeyTester();
	}

	/**
	 * testKeyTester
	 * @return void
	 * @covers \pvc\container\defs\DefinitionCollectionKeyTester::testValue
	 */
	public function testKeyTester(): void
	{
		self::assertTrue($this->keyTester->testValue('some_string'));
		self::assertFalse($this->keyTester->testValue(4));
	}
}
