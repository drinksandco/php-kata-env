<?php

namespace Kata\Algorithm;

use Kata\Core\SequentialCollection;

class CoupleCollection extends SequentialCollection
{
    protected function collectionItemsClassName()
    {
        return Couple::class;
    }

    public static function fromPeopleArray(array $people): CoupleCollection
    {
        $couples = [];

        for ($i = 0; $i < count($people); $i++) {
            for ($j = $i + 1; $j < count($people); $j++) {
                $couple = new Couple($people[$i], $people[$j]);
                $couple->age_difference = $couple->younger_person->getBirthDate()->getTimestamp() - $couple->older_person->getBirthDate()->getTimestamp();

                $couples[] = $couple;
            }
        }

        return new self($couples);
    }

    public function getCoupleByAge  Criteria(int $age_criteria)
    {

        $couples_array = $this->all_items;

        $answer = $couples_array[0];

        foreach ($couples_array as $result) {
            switch ($age_criteria) {
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