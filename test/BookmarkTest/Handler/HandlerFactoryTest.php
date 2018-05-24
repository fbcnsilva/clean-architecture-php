<?php

declare(strict_types=1);

namespace BookmarkTest\Handler;

use Bookmark\Handler\IndexHandler;
use Bookmark\Handler\HandlerFactory;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Bookmark\UseCase\SqliteRepository;
use Bookmark\UseCase\RepositoryInterface;

class HandlerFactoryTest extends TestCase
{
    public function testFactory()
    {
        $this->container = $this->prophesize(ContainerInterface::class);
        $this->container
            ->get(SqliteRepository::class)
            ->willReturn($this->prophesize(RepositoryInterface::class));

        $factory = new HandlerFactory();

        $indexHandler = $factory($this->container->reveal(), IndexHandler::class, get_class($this->container->reveal()));

        $this->assertInstanceOf(IndexHandler::class, $indexHandler);
    }
}
