<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

final class FindCoupleByAgeDifference
{
    /** @var Person[] */
    private $people;

    public function __construct(array $people)
    {
        $this->people = $people;
    }

    public function find(int $finder_criteria): Couple
    {
        $couples_array = $this->generateCouples();

        if (count($couples_array) < 1) {
            return new Couple();
        }

        $couple = $this->findCoupleByAgeDifferenceCriteria($finder_criteria, ...$couples_array);

        return $couple;
    }

    private function generateCouples(): array
    {
        /** @var Couple[] $couples_array */
        $couples_array = [];

        for ($i = 0; $i < count($this->people); $i++) {
            for ($j = $i + 1; $j < count($this->people); $j++) {
                $couple = new Couple();

                if ($this->people[$i]->getBirthDate() < $this->people[$j]->getBirthDate()) {
                    $couple->older_person = $this->people[$i];
                    $couple->younger_person = $this->people[$j];
                } else {
                    $couple->older_person = $this->people[$j];
                    $couple->younger_person = $this->people[$i];
                }

                $couple->age_difference = $couple->younger_person->getBirthDate()->getTimestamp() - $couple->older_person->getBirthDate()->getTimestamp();

                $couples_array[] = $couple;
            }
        }
        return $couples_array;
    }

    private function findCoupleByAgeDifferenceCriteria(
        int $finder_criteria,
        Couple... $couples_array
    ): Couple {
        $answer = $couples_array[0];

        foreach ($couples_array as $result) {
            switch ($finder_criteria) {
                case AgeDifferenceCriteria::CLOSEST_BIRTH_DATES:
                    if ($result->age_difference < $answer->age_difference) {
                        $answer = $result;
                    }
                    break;

                case AgeDifferenceCriteria::FURTHEST_BIRTH_DATES:
                    if ($result->age_difference > $answer->age_difference) {
                        $answer = $result;
                    }
                    break;
            }
        }
        return $answer;
    }
}
