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

/**
 * @phpstan-import-type DefArray from ContainerBuilderInterface
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
	 * @param  array<DefArray>  $pvcDefinitions
	 *
	 * @return ContainerInterface
	 */
	public function build(array $pvcDefinitions): ContainerInterface
	{
		$pvcDefinitionCollection = $this->definitionCollectionBuilder->build($pvcDefinitions);

		$leagueDefinitionsArray = [];
		foreach($pvcDefinitionCollection as $pvcDefinition) {
			$leagueDefinition = new LeagueDefinition(
				$pvcDefinition->alias,
				$pvcDefinition->classString
			);
			foreach ($pvcDefinition->args as $arg) {
				$leagueDefinition->addArgument($arg);
			}
			$leagueDefinitionsArray[] = $leagueDefinition;
		}
		$aggregate = new DefinitionAggregate($leagueDefinitionsArray);
		$container = new Container($aggregate);

		/**
		 * add autowiring
		 */
		$container->delegate(new ReflectionContainer());

		return $container;
	}
}