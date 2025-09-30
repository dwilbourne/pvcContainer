<?php

namespace pvcTests\container\defs;

use pvc\container\defs\DefCollectionBuilder;
use PHPUnit\Framework\TestCase;
use pvc\container\defs\Definition;
use pvc\container\defs\DefinitionCollection;
use pvc\container\defs\DefinitionFactory;

/**
 * @phpstan-import-type DefArray from DefCollectionBuilder
 */
class DefCollectionBuilderTest extends TestCase
{
	protected DefCollectionBuilder $defCollectionBuilder;

	protected DefinitionFactory $definitionFactory;

	protected DefinitionCollection $definitionCollection;

	protected string $testFixture = __DIR__ . '/fixture/definitions.php';

	public function setUp(): void
	{
		$this->definitionFactory = new DefinitionFactory();
		$this->definitionCollection = new DefinitionCollection();
		$this->defCollectionBuilder = new DefCollectionBuilder($this->definitionFactory, $this->definitionCollection);
	}

	/**
	 * testConstruct
	 * @return void
	 * @covers \pvc\container\defs\DefCollectionBuilder::__construct
	 */
	public function testConstruct(): void
	{
		$this->assertInstanceOf(DefCollectionBuilder::class, $this->defCollectionBuilder);
	}

	/**
	 * testBuild
	 * @return void
	 * @covers \pvc\container\defs\DefCollectionBuilder::build
	 */
	public function testBuild(): void
	{
		/** @var array<DefArray> $defs */
		$defs = include $this->testFixture;
		$this->defCollectionBuilder->build($defs);
		foreach ($this->definitionCollection as $def) {
			self::assertInstanceOf(Definition::class, $def);
		}
	}
}
