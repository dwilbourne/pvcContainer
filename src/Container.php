<?php

declare (strict_types=1);

use League\Container\Definition\Definition as LeagueDefinition;
use League\Container\Definition\DefinitionAggregate;
use League\Container\ReflectionContainer;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use League\Container\Container as LeagueContainer;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class Container
 */
class Container implements ContainerInterface
{
	protected ContainerInterface $container;

	protected string $definitionsFile = __DIR__.'/impl/league/psr/definitions.php';

	public function __construct(?string $definitionFile = null)
	{
		/** @var array<Definition> $defs */
		$defs = include($definitionFile ?? $this->definitionsFile);
		$aggregate = new DefinitionAggregate($defs);
		$this->container = new LeagueContainer($aggregate);

		/**
		 * enable autowiring
		 */
		$this->container->delegate(new ReflectionContainer());
	}

	public function add(Definition $definition): void
	{

	}

	/**
	 * has
	 * @param string $id
	 * @return bool
	 */
	public function has(string $id): bool
	{
		return $this->container->has($id);
	}

	/**
	 * get
	 * @param string $id
	 * @return mixed
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 */
	public function get(string $id): mixed
	{
		return $this->container->get($id);
	}
}