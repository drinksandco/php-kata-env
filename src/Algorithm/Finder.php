<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

final class Finder
{
    /** @var Person[] */
    private $people;

    public function __construct(array $people)
    {
        $this->people = $people;
    }

    public function find(int $ft): Couple
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

        if (count($couples_array) < 1) {
            return new Couple();
        }

        $answer = $couples_array[0];

        foreach ($couples_array as $result) {
            switch ($ft) {
                case FT::ONE:
                    if ($result->age_difference < $answer->age_difference) {
                        $answer = $result;
                    }
                    break;

                case FT::TWO:
                    if ($result->age_difference > $answer->age_difference) {
                        $answer = $result;
                    }
                    break;
            }
        }

        return $answer;
    }
}
