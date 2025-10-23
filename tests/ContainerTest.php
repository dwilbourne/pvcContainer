<?php

namespace pvcTests\container;

use PHPUnit\Framework\MockObject\MockObject;
use Psr\Container\ContainerInterface;
use pvc\container\Container;
use PHPUnit\Framework\TestCase;
use pvc\interfaces\container\ContainerBuilderInterface;
use pvc\interfaces\container\DefinitionInterface;

/**
 * @phpstan-import-type DefinitionArray from DefinitionInterface
 */
class ContainerTest extends TestCase
{
	protected ContainerBuilderInterface $builder;

	protected ContainerInterface&MockObject $psrInterface;

	protected string $definitionsFile = __DIR__.'/fixture/definitions.php';

	protected Container $container;

	protected function setUp(): void
	{
		/** @var array<DefinitionArray> $definitions */
		$definitions = include $this->definitionsFile;
		$this->builder = $this->createMock(ContainerBuilderInterface::class);
		$this->psrInterface = $this->createMock(ContainerInterface::class);
		$this->builder->method('build')->willReturn($this->psrInterface);
		$this->container = new Container($this->builder, $definitions);
	}

	/**
	 * testConstruct
	 * @return void
	 * @covers \pvc\container\Container::__construct
	 */
	public function testConstruct(): void
	{
		self::assertInstanceOf(Container::class, $this->container);
	}

	/**
	 * testHas
	 * @return void
	 * @covers \pvc\container\Container::has
	 */
	public function testHas(): void
	{
		$this->psrInterface->expects(self::once())->method('has')->willReturn(true);
		self::assertTrue($this->container->has('foo'));
	}

	/**
	 * testHas
	 * @return void
	 * @covers \pvc\container\Container::get
	 */
	public function testGet(): void
	{
		$alias = 'foo';
		$containerEntry = 'some value';
		$this->psrInterface->expects(self::once())->method('get')->with($alias)->willReturn($containerEntry);
		self::assertEquals($containerEntry, $this->container->get($alias));
	}
}
