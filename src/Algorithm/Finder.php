<?php

declare(strict_types=1);

namespace Kata\Algorithm;

use function count;

final class Finder
{
    /** @var Person[] */
    private $people;

    public function __construct(array $some_people)
    {
        $this->people = $some_people;
    }

    public function find(int $criteria): AgeComparatorResult
    {
        /** @var AgeComparatorResult[] $results */
        $results = [];
        $number_of_people = count($this->people);

        foreach ($this->people as $index => $person) {
            for ($j = $index + 1; $j < $number_of_people; $j++) {
                $results[] = $this->compareTwoBirthDates($person, $j);
            }
        }

        if (count($results) < 1) {
            throw new \InvalidArgumentException('Add at least two people');
        }

        $answer = $results[0];

        foreach ($results as $result) {
            switch ($criteria) {
                case Criteria::CLOSEST:
                    if ($result->age_difference < $answer->age_difference) {
                        $answer = $result;
                    }
                    break;

                case Criteria::FURTHEST:
                    if ($result->age_difference > $answer->age_difference) {
                        $answer = $result;
                    }
                    break;
            }
        }

        return $answer;
    }

    private function compareTwoBirthDates(
        Person $person,
        int $j
    ): AgeComparatorResult{
        if ($person->birthDate() < $this->people[$j]->birthDate()) {
            return new AgeComparatorResult($person, $this->people[$j]);
        }

        return new AgeComparatorResult($this->people[$j], $person);
    }
}
