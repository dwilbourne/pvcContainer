<?php

namespace pvcTests\container\defs;

use PHPUnit\Framework\MockObject\MockObject;
use pvc\container\defs\DefinitionCollection;
use PHPUnit\Framework\TestCase;
use pvc\interfaces\container\DefinitionInterface;
use pvc\interfaces\validator\ValTesterInterface;

class DefinitionCollectionTest extends TestCase
{
	protected DefinitionCollection $definitionCollection;
	protected function setUp(): void
	{
		$this->definitionCollection = new DefinitionCollection();
	}

	/**
	 * testConstruct
	 * @return void
	 * @covers \pvc\container\defs\DefinitionCollection::__construct
	 */
	public function testConstruct(): void
	{
		$this->assertInstanceOf(DefinitionCollection::class, $this->definitionCollection);
	}

	/**
	 * testHydrate
	 * @return void
	 * @covers \pvc\container\defs\DefinitionCollection::hydrate
	 * @covers \pvc\container\defs\DefinitionCollection::hasKey
	 */
	public function testHydrate(): void
	{
		$def1 = $this->createMock(DefinitionInterface::class);
		$alias1 = 'alias1';
		$def1->method('getAlias')->willReturn($alias1);

		$def2 = $this->createMock(DefinitionInterface::class);
		$alias2 = 'alias2';
		$def2->method('getAlias')->willReturn($alias2);

		$defs = [$def1, $def2];

		$this->definitionCollection->hydrate($defs);

		/**
		 * verify collection uses aliases as keys
		 */
		$expectedResult = [$alias1 => $def1, $alias2 => $def2];
		self::assertEquals($expectedResult, iterator_to_array($this->definitionCollection));

		self::assertTrue($this->definitionCollection->hasKey($alias1));
		self::assertFalse($this->definitionCollection->hasKey('foo'));
	}
}
