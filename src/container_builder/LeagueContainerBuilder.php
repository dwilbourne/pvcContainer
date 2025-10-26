<?php

declare(strict_types=1);

namespace pvc\container\container_builder;

use League\Container\Container;
use League\Container\Definition\Definition as LeagueDefinition;
use League\Container\Definition\DefinitionAggregate;
use League\Container\ReflectionContainer;
use Psr\Container\ContainerInterface;
use pvc\container\defs\DefinitionCollection;
use pvc\interfaces\container\ContainerBuilderInterface;
use pvc\interfaces\container\DefinitionInterface;

class LeagueContainerBuilder implements ContainerBuilderInterface
{

	public function __construct(
		protected DefinitionCollection $definitionCollection,
	) {}

	/**
	 * build
	 *
	 * @param  array<DefinitionInterface>  $definitions
	 *
	 * @return ContainerInterface
	 */
	public function build(array $definitions): ContainerInterface
	{
		$this->definitionCollection->hydrate($definitions);

		$leagueDefinitionsArray = array_map([$this, 'buildSingle'], iterator_to_array($this->definitionCollection));
		$aggregate = new DefinitionAggregate($leagueDefinitionsArray);
		$container = new Container($aggregate);

		/**
		 * add autowiring
		 */
		$container->delegate(new ReflectionContainer());

		return $container;
	}

	protected function buildSingle(DefinitionInterface $definition): LeagueDefinition
	{
		$leagueDefinition = new LeagueDefinition(
			$definition->getAlias(),
			$definition->getClassString(),
		);

		$leagueDefinition->addArguments($definition->getConstructorArgs());

		foreach($definition->getMethodCalls() as $methodCall) {
			$leagueDefinition->addMethodCall($methodCall->getMethodName(), $methodCall->getArguments());
		}

		return $leagueDefinition;
	}
}