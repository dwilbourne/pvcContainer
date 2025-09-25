<?php

/**
 * @package pvcdi
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

declare (strict_types=1);

use DI\Container;
use DI\ContainerBuilder;
use PHPUnit\Framework\TestCase;
use pvc\err\ExceptionLibraryCodes;

class DiContainerTest extends TestCase
{
    protected Container $container;

    public function setUp() : void
    {
        $builder = new ContainerBuilder();
        $builder->addDefinitions( '../src/Messages.php');
        $this->container = $builder->build();
    }

    public function testExceptionLibraryCodes() : void
    {
        $libraryCodes = $this->container->get(ExceptionLibraryCodes::class);
        self::assertInstanceOf(ExceptionLibraryCodes::class, $libraryCodes);
    }

}
