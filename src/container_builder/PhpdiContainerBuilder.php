<?php

declare(strict_types=1);

namespace pvc\container\container_builder;

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use pvc\container\defs\DefCollectionBuilder;
use pvc\interfaces\container\ContainerBuilderInterface;

use function DI\create;

/**
 * @phpstan-import-type DefArray from ContainerBuilderInterface
 */
class PhpdiContainerBuilder implements ContainerBuilderInterface
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

		$phpdiDefinitionsArray = [];

		foreach($pvcDefinitionCollection as $definition) {
			$phpdiDefinitionsArray[$definition->alias] = create($definition->classString)->constructor(...$definition->args);
		}

		$builder = new ContainerBuilder();
		$builder->addDefinitions($phpdiDefinitionsArray);
		return $builder->build();
	}
}