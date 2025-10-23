<?php

namespace pvc\container\defs;

use pvc\interfaces\container\DefinitionInterface;
use pvc\interfaces\container\MethodCallInterface;

/**
 * @phpstan-import-type Args from DefinitionInterface
 * @phpstan-import-type MethodCallArray from DefinitionInterface
 */
readonly class MethodCall implements MethodCallInterface
{
	public string $methodName;

	/**
	 * @var Args
	 */
	public array $arguments;

	/**
	 * @param  MethodCallArray  $methodCallArray
	 */
	public function __construct (array $methodCallArray)
	{
		$this->methodName = $methodCallArray['methodName'];
		$this->arguments = $methodCallArray['arguments'] ?? [];
	}

	public function getMethodName(): string
	{
		return $this->methodName;
	}

	/**
	 * getArguments
	 * @return Args
	 */
	public function getArguments(): array
	{
		return $this->arguments;
	}


}