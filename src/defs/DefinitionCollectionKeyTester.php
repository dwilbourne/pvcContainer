<?php

namespace pvc\container\defs;

use pvc\interfaces\validator\ValTesterInterface;

/**
 * @implements ValTesterInterface<mixed>
 */
class DefinitionCollectionKeyTester implements ValTesterInterface
{

	public function testValue(mixed $value): bool
	{
		return is_string($value);
	}
}