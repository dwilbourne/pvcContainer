<?php

declare (strict_types=1);

namespace pvc\container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use pvc\interfaces\container\ContainerBuilderInterface;
use pvc\interfaces\container\DefinitionInterface;

/**
 * Class Container
 * @phpstan-import-type DefinitionArray from DefinitionInterface
 * @phpstan-import-type DefinitionsArray from DefinitionInterface
 *
 * some container implementations provide a mechanism for creating a new instance of an object each time
 * it is retrieved from the container.  E.g. the concept of a factory is embedded in the definitions which
 * fuel the container (see League\Container from the php League)
 *
 * Other container implementations do not. (see phhpdi).
 *
 * This discrepancy arises because of the PDS-11 specification which says that when you get an object
 * from the container, it MAY or MAY NOT be the same instance each time.
 *
 * In my view, this is a flaw.  The PSR should define a specific behavior.  For example, if
 * all containers should be able to make a new instance each time, then change the PSR to add
 * a 'make' method to ContainerInterface.
 *
 * But since that is not currently the case, the pvc Container->get method will always return the same instance
 * of an object because all implementations are capable of that much.  Of course, if that object is
 * a factory, then you can use that factory in your code to make as many new instances of something else as you want.
 */
class Container implements ContainerInterface
{
	protected ContainerInterface $container;

	/**
	 * @param  ContainerBuilderInterface  $containerBuilder
	 * @param  DefinitionsArray  $definitions
	 */
	public function __construct(
		ContainerBuilderInterface $containerBuilder,
		array $definitions
	)
	{
        $this->container = $containerBuilder->build($definitions);
	}

	/**
	 * has
	 * @param string $id
	 * @return bool
	 */
	public function has(string $id): bool
	{
		return $this->container->has($id);
	}

	/**
	 * get
	 * @param string $id
	 * @return mixed
	 * @throws ContainerExceptionInterface
	 * @throws NotFoundExceptionInterface
	 * successive calls to get will always return the same instance
	 */
	public function get(string $id): mixed
	{
		return $this->container->get($id);
	}
}