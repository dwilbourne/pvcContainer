<?php

declare (strict_types=1);

namespace pvc\container;

use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use pvc\interfaces\container\ContainerBuilderInterface;

/**
 * Class Container
 * @phpstan-import-type DefArray from ContainerBuilderInterface
 */
class Container implements ContainerInterface
{
	protected ContainerInterface $container;

	protected string $definitionsFile = __DIR__.'/defs/definitions.php';

	public function __construct(ContainerBuilderInterface $containerBuilder)
	{
		/** @var array<DefArray> $defs */
		$defs = include($this->definitionsFile);
        $this->container = $containerBuilder->build($defs);
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
	 */
	public function get(string $id): mixed
	{
		return $this->container->get($id);
	}
}