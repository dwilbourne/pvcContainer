<?php

declare (strict_types=1);

namespace pvcTests\container\container_builder;

use pvc\container\container_builder\LeagueContainerBuilder;
use pvc\container\container_builder\PhpdiContainerBuilder;
use pvc\container\defs\DefCollectionBuilder;

/**
 * @covers \pvc\container\container_builder\PhpdiContainerBuilder::__construct
 * @covers \pvc\container\container_builder\PhpdiContainerBuilder::build
 * @covers \pvc\container\container_builder\PhpdiContainerBuilder::buildSingle
 * @covers \pvc\container\container_builder\PhpdiContainerBuilder::resolveArgument
 */
class PhpdiContainerTest extends AbstractContainerTest
{
	function getContainerBuilder(DefCollectionBuilder $defCollectionBuilder): PhpdiContainerBuilder
	{
		return new PhpdiContainerBuilder($defCollectionBuilder);
	}
}
