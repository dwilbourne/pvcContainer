<?php

declare(strict_types=1);

namespace pvc\container\defs;

readonly class Definition
{
	/**
	 * @param  string  $alias
	 * @param  string  $classString
	 * @param  array<mixed>  $args
	 */
	public function __construct(
		public string $alias,
		public string $classString,
		public array $args = [],
	) {
	}
}