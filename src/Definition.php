<?php

readonly class Definition
{
	public function __construct(
		public string $id,
		public string $object,
		public array $args = [],
	) {}
}