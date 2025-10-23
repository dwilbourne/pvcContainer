<?php

declare(strict_types=1);

namespace pvc\container\defs;

use pvc\interfaces\container\DefinitionInterface;

/**
 * @phpstan-import-type DefinitionArray from DefinitionInterface
 * @phpstan-import-type DefinitionsArray from DefinitionInterface
 */
class DefCollectionBuilder
{
	/**
	 * @param  DefinitionFactory  $definitionFactory
	 * @param  DefinitionCollection  $definitionCollection
	 */
	public function __construct(
		protected DefinitionFactory $definitionFactory,
		protected DefinitionCollection $definitionCollection
	)
	{
	}

	/**
	 * build
	 *
	 * @param  DefinitionsArray  $definitionsArray
	 *
	 * @return DefinitionCollection
	 */
	public function build(array $definitionsArray): DefinitionCollection
	{
		foreach ($definitionsArray as $defArray) {
			$definition = $this->definitionFactory->makeDefinition($defArray);
			$this->definitionCollection->add($definition->getAlias(), $definition);
		}
		return $this->definitionCollection;
	}
}