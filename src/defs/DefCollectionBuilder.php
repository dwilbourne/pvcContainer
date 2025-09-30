<?php

declare(strict_types=1);

namespace pvc\container\defs;


use pvc\interfaces\container\ContainerBuilderInterface;

/**
 * @phpstan-import-type DefArray from ContainerBuilderInterface
 */
class DefCollectionBuilder
{
	public function __construct(
		protected DefinitionFactory $definitionFactory,
		protected DefinitionCollection $definitionCollection
	)
	{
	}

	/**
	 * build
	 * @param  array<DefArray>  $defs
	 *
	 * @return DefinitionCollection
	 */
	public function build(array $defs): DefinitionCollection
	{
		foreach($defs as $def) {
			$definition = $this->definitionFactory->makeDefinition($def);
			$this->definitionCollection->offsetSet($definition->alias, $definition);
		}
		return $this->definitionCollection;
	}
}