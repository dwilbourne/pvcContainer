<?php

declare(strict_types=1);

namespace pvc\container\defs;

use ArrayIterator;
use pvc\interfaces\container\DefinitionInterface;
use pvc\struct\collection\Collection;

/**
 * @extends Collection<string, DefinitionInterface>
 * @phpstan-import-type DefinitionsArray from DefinitionInterface
 */
class DefinitionCollection extends Collection
{
	/**
	 * @param  DefinitionCollectionKeyTester  $keyTester
	 * @param  DefinitionCollectionValueTester  $valueTester
	 * @param  DefinitionsArray  $definitions
	 */
	public function __construct(
		DefinitionCollectionKeyTester $keyTester,
		DefinitionCollectionValueTester $valueTester,
		array $definitions = []
	)
	{
		/** @var ArrayIterator<string, DefinitionInterface> $iterator */
		$iterator = new ArrayIterator($definitions);
		parent::__construct($iterator);

		$this->keyTester = $keyTester;
		$this->valueTester = $valueTester;
	}
}