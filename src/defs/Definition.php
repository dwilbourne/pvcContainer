<?php

declare(strict_types=1);

namespace pvc\container\defs;

use pvc\interfaces\container\DefinitionInterface;
use pvc\interfaces\container\MethodCallInterface;

/**
 * @phpstan-import-type Args from DefinitionInterface
 * @phpstan-import-type DefinitionArray from DefinitionInterface
 * @phpstan-import-type MethodCallArray from DefinitionInterface
 */
readonly class Definition implements DefinitionInterface
{
	/**
	 * @var string
	 * if not specified in the array, the resolvableString field in the array is used here
	 */
	public string $alias;

	/**
	 * @var string
	 * often a class string but can also be an alias for something else in the container
	 */
	public string $resolvableString;

	/**
	 * @var Args
	 */
	public array $constructorArgs;

	/**
	 * @var array<MethodCall>
	 */
	public array $methodCalls;

	/**
	 * @param  DefinitionArray  $defArray
	 */
	public function __construct(array $defArray)
	{
		$this->alias = $defArray['alias'] ?? $defArray['resolvableString'];
		$this->resolvableString = $defArray['resolvableString'];
		$this->constructorArgs = $defArray['constructorArgs'] ?? [];

		/**
		 * array<MethodCall> $mc
		 */
		$mc = [];
		if (isset($defArray['methodCalls'])) {
			foreach($defArray['methodCalls'] as $methodCallArray) {
				$mc[] = new MethodCall($methodCallArray);
			}
		}
		$this->methodCalls = $mc;
	}

	public function getAlias(): string
	{
		return $this->alias;
	}

	public function getResolvableString(): string
	{
		return $this->resolvableString;
	}

	/**
	 * getConstructorArgs
	 * @return Args
	 */
	public function getConstructorArgs(): array
	{
		return $this->constructorArgs;
	}

	/**
	 * getMethodCalls
	 * @return array<MethodCallInterface>
	 */
	public function getMethodCalls(): array
	{
		return $this->methodCalls;
	}


}