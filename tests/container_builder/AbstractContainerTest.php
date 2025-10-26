<?php

declare (strict_types=1);

namespace pvcTests\container\container_builder;

use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use pvc\container\defs\DefinitionCollection;
use pvc\interfaces\container\ContainerBuilderInterface;
use pvc\interfaces\container\DefinitionInterface;
use pvcTests\container\fixture\Bar;
use pvcTests\container\fixture\Foo;

abstract class AbstractContainerTest extends TestCase
{
    protected ContainerInterface $container;

	protected string $testFixture = __DIR__.'/../fixture/definitions.php';

	abstract  function getContainerBuilder(DefinitionCollection $definitionCollection): ContainerBuilderInterface;

    public function setUp() : void
    {
		$definitionCollection = new DefinitionCollection();
		$containerBuilder = $this->getContainerBuilder($definitionCollection);

		/** @var array<DefinitionInterface> $definitions */
		$definitions = include $this->testFixture;

        $this->container = $containerBuilder->build($definitions);
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
