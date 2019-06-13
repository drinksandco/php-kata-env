<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

use DateTime;
use function dump;

final class Finder
{
    /** @var Person[] */
    private $peopleByAgeDifferenceCollection;

    public function __construct(PeopleByAgeDifferenceCollection $peopleByAgeDifferenceCollection)
    {
        $this->peopleByAgeDifferenceCollection = $peopleByAgeDifferenceCollection;
    }

    public function find(int $finderCriteria): PeopleByAgeDifference
    {
        /** @var PeopleByAgeDifference[] $tr */
        $tr = [];

        /** @var Person $firstPerson */
        foreach ($this->peopleByAgeDifferenceCollection as $firstPerson) {
            /** @var Person $secondPerson */
            foreach ($this->peopleByAgeDifferenceCollection as $secondPerson) {
                if ($firstPerson->equals($secondPerson)){
                    continue;
                }
                $peopleByAgeDifference = new PeopleByAgeDifference();

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
