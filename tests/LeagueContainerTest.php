<?php

declare (strict_types=1);

namespace pvcTests\container;

use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use pvc\container\Container;
use pvc\container\container_builder\LeagueContainerBuilder;
use pvc\container\defs\DefCollectionBuilder;
use pvc\container\defs\DefinitionCollection;
use pvc\container\defs\DefinitionFactory;

class LeagueContainerTest extends TestCase
{
    protected Container $container;

    public function setUp() : void
    {
		$definitionFactory = new DefinitionFactory();
		$definitionCollection = new DefinitionCollection();
		$defCollectionBuilder = new DefCollectionBuilder($definitionFactory, $definitionCollection);
        $builder = new LeagueContainerBuilder($defCollectionBuilder);
        $this->container = new Container($builder);
    }

	/**
	 * testContainer
	 * @return void
	 * @covers \pvc\container\Container::__construct
	 * @covers \pvc\container\container_builder\LeagueContainerBuilder::__construct
	 * @covers \pvc\container\container_builder\LeagueContainerBuilder::build
	 * @covers \pvc\container\Container::has
	 * @covers \pvc\container\Container::get
	 */
	public function testContainer(): void
	{
		self::assertTrue($this->container->has(Client::class));
		self::assertInstanceOf(Client::class, $this->container->get(Client::class));
	}
}
