<?php

declare(strict_types=1);

namespace pvc\container\defs;

use pvc\interfaces\container\DefinitionInterface;

/**
 * @phpstan-import-type DefinitionArray from DefinitionInterface
 */
class DefinitionFactory
{
	/**
	 * makeDefinition
	 * @param  DefinitionArray  $defArray
	 *
	 * @return DefinitionInterface
	 */
	public function makeDefinition(array $defArray): DefinitionInterface
	{
		return new Definition($defArray);
	}
}