<?php

declare(strict_types=1);

namespace pvc\container\container_builder;

use DI\ContainerBuilder;
use DI\Definition\Helper\DefinitionHelper;
use Psr\Container\ContainerInterface;
use pvc\container\defs\DefinitionCollection;
use pvc\interfaces\container\ContainerBuilderInterface;
use pvc\interfaces\container\DefinitionInterface;

use function DI\create;
use function DI\get;

class PhpdiContainerBuilder implements ContainerBuilderInterface
{


	public function __construct(
		protected DefinitionCollection $definitionCollection,
	) {}

	/**
	 * build
	 *
	 * @param  array<DefinitionInterface>  $definitions
	 *
	 * @return ContainerInterface
	 */
	public function build(array $definitions): ContainerInterface
	{
		$this->definitionCollection->hydrate($definitions);

		$phpdiDefinitionsArray = array_map([$this, 'buildSingle'], iterator_to_array($this->definitionCollection));
		$builder = new ContainerBuilder();
		$builder->addDefinitions($phpdiDefinitionsArray);
		return $builder->build();
	}

	/**
	 * phpdi is clumsy at best.  This logic should be built into the phpdi package itself...
	 */
	protected function  buildSingle(DefinitionInterface $pvcDefinition): DefinitionHelper
	{
		$phpdiDefinition = create($pvcDefinition->getClassString());

		$phpdiDefinition->constructor(... array_map([$this, 'resolveArgument'], $pvcDefinition->getConstructorArgs()));

		foreach ($pvcDefinition->getMethodCalls() as $methodCall) {
			$phpdiDefinition->method($methodCall->getMethodName(), ... array_map([$this, 'resolveArgument'], $methodCall->getArguments()));
		}

		return $phpdiDefinition;
	}

	/**
	 * resolveArgument
	 * @param mixed $arg
	 *
	 * @return mixed
	 */
	protected function resolveArgument($arg): mixed
	{
		$resolved = $arg;
		if (is_string($arg) && $this->definitionCollection->hasKey($arg)) {
			$resolved = get($arg);
		}
		return $resolved;
	}
}