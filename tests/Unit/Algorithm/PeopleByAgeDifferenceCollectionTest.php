<?php

declare(strict_types=1);

namespace KataTest\Unit\Algorithm;

use Kata\Algorithm\PeopleByAgeDifference;
use Kata\Algorithm\PeopleByAgeDifferenceCollection;
use PHPUnit\Framework\TestCase;

class PeopleByAgeDifferenceCollectionTest extends TestCase
{
    public function testItShouldBeCreated(): void
    {
        $collection = new PeopleByAgeDifferenceCollection();
        $this->assertInstanceOf(PeopleByAgeDifferenceCollection::class, $collection);
    }

    public function testItShouldBeIterableAndTraversable(): void
    {
        $collection = new PeopleByAgeDifferenceCollection();
        $this->assertIsIterable($collection);
    }

    public function testItShouldBeCountable(): void
    {
        $collection = new PeopleByAgeDifferenceCollection();
        $this->assertCount(0, $collection);
    }

    public function testItShouldBeCreatedWithAListOfPeopleByAgeDifference(): void
    {
        $collection = new PeopleByAgeDifferenceCollection([new PeopleByAgeDifference()]);
        $this->assertCount(1, $collection);
    }
}
