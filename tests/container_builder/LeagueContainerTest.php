<?php

declare (strict_types=1);

namespace pvcTests\container\container_builder;

use pvc\container\container_builder\LeagueContainerBuilder;
use pvc\container\defs\DefCollectionBuilder;

/**
 * @covers \pvc\container\container_builder\LeagueContainerBuilder::__construct
 * @covers \pvc\container\container_builder\LeagueContainerBuilder::build
 * @covers \pvc\container\container_builder\LeagueContainerBuilder::buildSingle
 */
class LeagueContainerTest extends AbstractContainerTest
{
	function getContainerBuilder(DefCollectionBuilder $defCollectionBuilder): LeagueContainerBuilder
	{
		return new LeagueContainerBuilder($defCollectionBuilder);
	}
}
