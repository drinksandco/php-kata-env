<?php

declare(strict_types=1);

namespace Kata\Algorithm;

use Countable;
use IteratorAggregate;

class PeopleByAgeDifferenceCollection implements IteratorAggregate, Countable
{
    private $peopleByAgeDifferenceList;

    public function __construct(array $peopleByAgeDifferenceList = [])
    {
        $this->peopleByAgeDifferenceList = $peopleByAgeDifferenceList;
    }

    public function getIterator(): iterable
    {
        yield from $this->peopleByAgeDifferenceList;

    }

    public function count(): int
    {
        return count($this->peopleByAgeDifferenceList);
    }
}
