<?php

declare(strict_types=1);

namespace pvc\container\defs;

use pvc\interfaces\container\ContainerBuilderInterface;

/**
 * @phpstan-import-type DefArray from ContainerBuilderInterface
 */
class DefinitionFactory
{
	/**
	 * makeDefinition
	 * @param  DefArray  $defArray
	 *
	 * @return Definition
	 */
	public function makeDefinition(array $defArray): Definition
	{
		return new Definition($defArray['alias'], $defArray['class-string'], $defArray['args'] ?? []);
	}
}