<?php

declare(strict_types=1);

namespace pvc\container\defs;

use pvc\interfaces\container\DefinitionInterface;
use pvc\interfaces\container\MethodCallInterface;

class Definition implements DefinitionInterface
{
	/**
	 * @var string
	 */
	protected string $alias;

	/**
	 * @var string
	 */
	protected string $classString;

	/**
	 * @var array<mixed>
	 */
	protected array $constructorArgs = [];

	/**
	 * @var array<MethodCallInterface>
	 */
	protected array $methodCalls = [];

	/**
	 * @param  string  $aliasOrClassString
	 * @param  ?string  $classString
	 */
	public function __construct(string $aliasOrClassString, ?string $classString = null)
	{
		if (null !== $classString) {
			   $this->alias = $aliasOrClassString;
			   $this->classString = $classString;
		} else {
				$this->alias = $aliasOrClassString;
				$this->classString = $aliasOrClassString;
		}
	}

	public function getAlias(): string
	{
		return $this->alias;
	}

	public function getClassString(): string
	{
		return $this->classString;
	}

	/**
	 * getConstructorArgs
	 * @return array<mixed>
	 */
	public function getConstructorArgs(): array
	{
		return $this->constructorArgs;
	}

	/**
	 * addConstructorArgs
	 * @param  mixed  $args
	 *
	 * @return DefinitionInterface
	 */
	public function addConstructorArgs(... $args): DefinitionInterface
	{
		$this->constructorArgs = array_merge($this->constructorArgs, $args);
		return $this;
	}

	/**
	 * getMethodCalls
	 * @return array<MethodCallInterface>
	 */
	public function getMethodCalls(): array
	{
		return $this->methodCalls;
	}

	/**
	 * addMethodCall
	 * @param  string  $methodName
	 * @param mixed|null $args
	 *
	 * @return DefinitionInterface
	 */
	public function addMethodCall(string $methodName, ... $args): DefinitionInterface
	{
		$this->methodCalls[] = new MethodCall($methodName, ... $args);
		return $this;
	}
}
