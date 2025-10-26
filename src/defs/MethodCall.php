<?php

namespace pvc\container\defs;

use pvc\interfaces\container\DefinitionInterface;
use pvc\interfaces\container\MethodCallInterface;

class MethodCall implements MethodCallInterface
{
	public string $methodName;

	/**
	 * @var array<mixed>
	 */
	public array $arguments = [];

	/**
	 * @param  string  $methodName
	 * @param mixed|null ...$args
	 */
	public function __construct (string $methodName, ... $args)
	{
		$this->methodName = $methodName;
		$this->arguments  = array_merge($this->arguments, $args);
	}

	public function getMethodName(): string
	{
		return $this->methodName;
	}

	/**
	 * getArguments
	 * @return array<mixed>
	 */
	public function getArguments(): array
	{
		return $this->arguments;
	}
}