<?php

namespace pvcTests\container\fixture;

class Foo
{
	public function __construct(protected Bar $bar, protected Baz $baz, protected string $x) {}

	public function initialize(Quux $quux): void {}
}