<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

final class Finder
{
    /** @var Person[] */
    private $people;

    public function __construct(array $p)
    {
        $this->people = $p;
    }

    public function find(int $criteria): F
    {
        /** @var F[] $results */
        $results = [];

        for ($i = 0; $i < count($this->people); $i++) {
            for ($j = $i + 1; $j < count($this->people); $j++) {
                $result = new F();

                if ($this->people[$i]->birthDate < $this->people[$j]->birthDate) {
                    $result->person_one = $this->people[$i];
                    $result->person_two = $this->people[$j];
                } else {
                    $result->person_one = $this->people[$j];
                    $result->person_two = $this->people[$i];
                }

                $result->age_difference = $result->person_two->birthDate->getTimestamp()
                    - $result->person_one->birthDate->getTimestamp();

                $results[] = $result;
            }
        }

        if (count($results) < 1) {
            return new F();
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
}
