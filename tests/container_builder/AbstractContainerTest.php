<?php

declare (strict_types=1);

namespace pvcTests\container\container_builder;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use pvc\container\defs\DefCollectionBuilder;
use pvc\container\defs\DefinitionCollection;
use pvc\container\defs\DefinitionCollectionKeyTester;
use pvc\container\defs\DefinitionCollectionValueTester;
use pvc\container\defs\DefinitionFactory;
use pvc\interfaces\container\ContainerBuilderInterface;
use pvc\interfaces\container\DefinitionInterface;
use pvc\interfaces\validator\ValTesterInterface;
use pvcTests\container\fixture\Bar;
use pvcTests\container\fixture\Foo;

/**
 * @phpstan-import-type DefinitionsArray from DefinitionInterface
 */
abstract class AbstractContainerTest extends TestCase
{
    protected ContainerInterface $container;

	protected ContainerBuilderInterface $containerBuilder;

	protected string $testFixture = __DIR__.'/../fixture/definitions.php';

	abstract  function getContainerBuilder(DefCollectionBuilder $defCollectionBuilder): ContainerBuilderInterface;

    public function setUp() : void
    {
		/**
		 * turn the pvc definitions into a collection of vendor-specific definitions
		 */
		$definitionFactory = new DefinitionFactory();
		$keyTester = new DefinitionCollectionKeyTester();
		$valueTester = new DefinitionCollectionValueTester();
		$definitionCollection = new DefinitionCollection($keyTester, $valueTester);


		$defCollectionBuilder = new DefCollectionBuilder($definitionFactory, $definitionCollection);

		/** @var DefinitionsArray $definitions */
		$definitions = include $this->testFixture;

        $this->containerBuilder = $this->getContainerBuilder($defCollectionBuilder);
        $this->container = $this->containerBuilder->build($definitions);
    }

	/**
	 * testGetObjectWithNoArgs
	 * @return void
	 * @covers \pvc\container\Container::__construct
	 * @covers \pvc\container\Container::has
	 * @covers \pvc\container\Container::get
	 */
	public function testGetObjectWithNoArgs(): void
	{
		self::assertTrue($this->container->has(Bar::class));
		self::assertInstanceOf(Bar::class, $this->container->get(Bar::class));
	}

	/**
	 * testGetObjectWithArgs
	 * @return void
	 * @coversNothing
	 */
	public function testGetObjectWithArgs(): void
	{
		self::assertInstanceOf(Foo::class, $this->container->get(Foo::class));
	}

	/**
	 * testGetObjectWithSetterInjection
	 * @return void
	 * @coversNothing
	 */
	public function testGetObjectWithSetterInjection(): void
	{
		self::assertInstanceOf(Foo::class, $this->container->get('FooInitialized'));
	}
}
