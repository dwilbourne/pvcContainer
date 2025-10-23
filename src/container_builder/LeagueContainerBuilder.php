<?php

declare(strict_types=1);

namespace pvc\container\container_builder;

use League\Container\Container;
use League\Container\Definition\Definition as LeagueDefinition;
use League\Container\Definition\DefinitionAggregate;
use League\Container\ReflectionContainer;
use Psr\Container\ContainerInterface;
use pvc\container\defs\DefCollectionBuilder;
use pvc\interfaces\container\ContainerBuilderInterface;
use pvc\interfaces\container\DefinitionInterface;

/**
 * @phpstan-import-type DefinitionArray from DefinitionInterface
 * @phpstan-import-type DefinitionsArray from DefinitionInterface
 */
class LeagueContainerBuilder implements ContainerBuilderInterface
{
	public function __construct(
		protected DefCollectionBuilder $definitionCollectionBuilder,
	)
	{
	}

	/**
	 * build
	 *
	 * @param  DefinitionsArray  $definitions
	 *
	 * @return ContainerInterface
	 */
	public function build(array $definitions): ContainerInterface
	{
		$pvcDefinitionCollection = $this->definitionCollectionBuilder->build($definitions);
		$leagueDefinitionsArray = array_map([$this, 'buildSingle'], $pvcDefinitionCollection->getElements());
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
			$definition->getResolvableString(),
		);

		$leagueDefinition->addArguments($definition->getConstructorArgs());

		foreach($definition->getMethodCalls() as $methodCall) {
			$leagueDefinition->addMethodCall($methodCall->getMethodName(), $methodCall->getArguments());
		}

		return $leagueDefinition;
	}
}