<?php

namespace pvcTests\container\defs;

use pvc\container\defs\DefCollectionBuilder;
use PHPUnit\Framework\TestCase;
use pvc\container\defs\Definition;
use pvc\container\defs\DefinitionCollection;
use pvc\container\defs\DefinitionCollectionKeyTester;
use pvc\container\defs\DefinitionCollectionValueTester;
use pvc\container\defs\DefinitionFactory;
use pvc\interfaces\container\DefinitionInterface;

/**
 * @phpstan-import-type DefinitionArray from DefinitionInterface
 */
class DefCollectionBuilderTest extends TestCase
{
	protected DefCollectionBuilder $defCollectionBuilder;

	protected DefinitionFactory $definitionFactory;

	protected DefinitionCollection $definitionCollection;

	protected string $testFixture = __DIR__.'/../fixture/definitions.php';

	public function setUp(): void
	{
		$this->definitionFactory = new DefinitionFactory();
		$keyTester = new DefinitionCollectionKeyTester();
		$valueTester = new DefinitionCollectionValueTester();
		$this->definitionCollection = new DefinitionCollection($keyTester, $valueTester);
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
		/** @var array<DefinitionArray> $defs */
		$defs = include $this->testFixture;
		$this->defCollectionBuilder->build($defs);
		foreach ($this->definitionCollection as $def) {
			self::assertInstanceOf(Definition::class, $def);
		}
	}
}
