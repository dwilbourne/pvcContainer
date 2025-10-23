<?php

namespace pvcTests\container\defs;

use PHPUnit\Framework\MockObject\MockObject;
use pvc\container\defs\DefinitionCollection;
use PHPUnit\Framework\TestCase;
use pvc\container\defs\DefinitionCollectionKeyTester;
use pvc\container\defs\DefinitionCollectionValueTester;
use pvc\interfaces\validator\ValTesterInterface;

class DefinitionCollectionTest extends TestCase
{
	protected DefinitionCollectionKeyTester&MockObject $keyTester;
	protected DefinitionCollectionValueTester&MockObject $valueTester;

	protected DefinitionCollection $collection;

	public function setUp(): void
	{
		$this->keyTester = $this->createMock(DefinitionCollectionKeyTester::class);
		$this->valueTester = $this->createMock(DefinitionCollectionValueTester::class);
		$this->collection = new DefinitionCollection($this->keyTester, $this->valueTester);
	}

	/**
	 * testConstruct
	 * @return void
	 * @covers \pvc\container\defs\DefinitionCollection::__construct
	 */
	public function testConstruct(): void
	{
		$this->assertInstanceOf(DefinitionCollection::class, $this->collection);
		self::assertInstanceOf(ValTesterInterface::class, $this->collection->keyTester);
		self::assertInstanceOf(ValTesterInterface::class, $this->collection->valueTester);
	}
}
