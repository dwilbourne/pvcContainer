<?php

namespace pvc\container\defs;

use pvc\interfaces\container\DefinitionInterface;
use pvc\interfaces\validator\ValTesterInterface;

/**
 * @implements ValTesterInterface<mixed>
 */
class DefinitionCollectionValueTester implements ValTesterInterface
{

	public function testValue(mixed $value): bool
	{
		return ($value instanceof DefinitionInterface);
	}
}