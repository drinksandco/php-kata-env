<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

use DateTime;
use function dump;

final class Finder
{
    /** @var Person[] */
    private $people;

    public function __construct(array $somePeople)
    {
        $this->people = $somePeople;
    }

    public function find(int $finderCriteria): PeopleByAgeDifference
    {
        /** @var PeopleByAgeDifference[] $tr */
        $tr = [];

        for ($i = 0; $i < count($this->people); $i++) {
            for ($j = $i + 1; $j < count($this->people); $j++) {
                $peopleByAgeDifference = new PeopleByAgeDifference();
                
                $firstPerson = $this->people[$i];
                $secondPerson = $this->people[$j];
                if ($this->isFirstBirthdaySmallerThanSecondOne(
                    $firstPerson->birthDate,
                    $secondPerson->birthDate
                )
                ) {
                    $peopleByAgeDifference->firstPerson = $firstPerson;
                    $peopleByAgeDifference->secondPerson = $secondPerson;
                } else {
                    $peopleByAgeDifference->firstPerson = $secondPerson;
                    $peopleByAgeDifference->secondPerson = $firstPerson;
                }

                $peopleByAgeDifference->timeDifference = $peopleByAgeDifference->secondPerson->birthDate->getTimestamp()
                    - $peopleByAgeDifference->firstPerson->birthDate->getTimestamp();

                $tr[] = $peopleByAgeDifference;
            }

        }

        if (count($tr) < 1) {
            return new PeopleByAgeDifference();
        }

        $answer = $tr[0];

        foreach ($tr as $result) {
            switch ($finderCriteria) {
                case FinderCriteria::CLOSEST:
                    if ($result->timeDifference < $answer->timeDifference) {
                        $answer = $result;
                    }
                    break;

                case FinderCriteria::FURTHEST:
                    if ($result->timeDifference > $answer->timeDifference) {
                        $answer = $result;
                    }
                    break;
            }
        }

        return $answer;
    }

    private function isFirstBirthdaySmallerThanSecondOne(
        DateTime $firstBirthday,
        DateTime $secondBirthday
    ): bool {
        return $firstBirthday < $secondBirthday;
    }
}
