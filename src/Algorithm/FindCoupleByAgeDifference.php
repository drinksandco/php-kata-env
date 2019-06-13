<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

final class FindCoupleByAgeDifference
{
    /** @var CoupleCollection[] */
    private $couples;

    public function __construct(array $people)
    {
        $this->couples = CoupleCollection::fromPeopleArray($people);
    }

    public function find(int $finder_criteria): Couple
    {
        if (count($this->couples) < 1) {
            return new Couple();
        }

        return $this->couples->getCoupleByAgeCriteria($finder_criteria);
    }

}
