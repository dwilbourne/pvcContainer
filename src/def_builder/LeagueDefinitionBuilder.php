<?php

namespace def_builder;

use Definition;
use League\Container\Definition\Definition as LeagueDefinition;

class LeagueDefinitionBuilder implements DefBuilderInterface
{
	public function buildLeagueDefinition(Definition $definition): LeagueDefinition
	{
		$def = new LeagueDefinition($definition->id, $definition->object);
		if (!empty($definition->args)) {
			foreach ($definition->args as $arg) {
				$def->addArgument($arg);
			}
		}
		return $def;
	}
}