<?php

declare(strict_types=1);

namespace pvc\container\defs;

use ArrayIterator;
use pvc\interfaces\container\DefinitionInterface;

/**
 * @extends \IteratorIterator<string, DefinitionInterface, ArrayIterator>
 */
class DefinitionCollection extends \IteratorIterator
{
	public function __construct()
	{
		/** @var ArrayIterator<string, DefinitionInterface> $iterator */
		$iterator = new ArrayIterator();
		parent::__construct($iterator);
	}

	/**
	 * hydrate
	 * @param  array<DefinitionInterface>  $definitions
	 *
	 * @return void
	 */
	public function hydrate(array $definitions): void
	{
		foreach($definitions as $definition) {
			/**
			 * phpstan does not know that the inner iterator is an array iterator and so it does not know about
			 * offsetSet
			 * @phpstan-ignore-next-line
			 */
			$this->getInnerIterator()->offsetSet($definition->getAlias(), $definition);
		}
	}

	/**
	 * hasKey
	 * @param  string  $key
	 * clumsy, but phpdi needs this because it will not try and recursively resolve arguments for constructors
	 * and method calls
	 * @return bool
	 */
	public function hasKey(string $key): bool
	{
		/**
		 * phpstan does not know that the inner iterator is an array iterator and so it does not know about
		 * offsetExists
		 * @phpstan-ignore-next-line
		 */
		return $this->getInnerIterator()->offsetExists($key);
	}
}