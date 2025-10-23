<?php

declare(strict_types=1);

namespace pvc\container\container_builder;

use DI\ContainerBuilder;
use DI\Definition\Helper\DefinitionHelper;
use Exception;
use Psr\Container\ContainerInterface;
use pvc\container\defs\DefCollectionBuilder;
use pvc\container\defs\DefinitionCollection;
use pvc\interfaces\container\ContainerBuilderInterface;
use pvc\interfaces\container\DefinitionInterface;

use function DI\create;
use function DI\get;

/**
 * @phpstan-import-type DefinitionArray from DefinitionInterface
 * @phpstan-import-type DefinitionsArray from DefinitionInterface
 */
class PhpdiContainerBuilder implements ContainerBuilderInterface
{
	protected DefinitionCollection $pvcDefinitionCollection;

	public function __construct(
		protected DefCollectionBuilder $definitionCollectionBuilder,
	) {
	}

	/**
	 * build
	 *
	 * @param  DefinitionsArray  $definitions
	 *
	 * @return ContainerInterface
	 */
	public function build(array $definitions): ContainerInterface
	{
		$this->pvcDefinitionCollection = $this->definitionCollectionBuilder->build($definitions);
		$phpdiDefinitionsArray = array_map([$this, 'buildSingle'], $this->pvcDefinitionCollection->getElements());
		$builder = new ContainerBuilder();
		$builder->addDefinitions($phpdiDefinitionsArray);
		return $builder->build();
	}

	/**
	 * phpdi is clumsy at best.  This logic should be built into the phpdi package itself...
	 */
	protected function  buildSingle(DefinitionInterface $pvcDefinition): DefinitionHelper
	{
		$phpdiDefinition = create($pvcDefinition->getResolvableString());

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
		if (is_string($arg) && $this->pvcDefinitionCollection->hasKey($arg)) {
			$resolved = get($arg);
		}
		return $resolved;
	}
}