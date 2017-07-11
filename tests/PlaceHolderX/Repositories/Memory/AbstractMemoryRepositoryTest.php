<?php

namespace Tests\PlaceHolderX\Repositories\Memory;

use PlaceHolderX\Exceptions\InvalidMemoryRepositoryItemsException;
use PlaceHolderX\Repositories\Memory\AbstractMemoryRepository;

class AbstractMemoryRepositoryTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     */
    public function throwExceptionWhenInvalidItemsAreGiven()
    {
        $this->expectException(InvalidMemoryRepositoryItemsException::class);
        $this->getMockBuilder(AbstractMemoryRepository::class)->setConstructorArgs(['InvalidArgument'])->getMock();
    }

}