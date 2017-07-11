<?php

namespace Tests\PlaceHolderX\Helpers\Repository;

use PlaceHolderX\Exceptions\InvalidSortDirectionException;
use PlaceHolderX\Helpers\Repository\SortOptions;

class SortOptionsTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @test
	 */
	public function failOnInvalidSortDirection()
	{
		$this->expectException(InvalidSortDirectionException::class);
		new SortOptions('Foo', 'Bar');
	}

}