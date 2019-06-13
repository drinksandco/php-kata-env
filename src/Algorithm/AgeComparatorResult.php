<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

final class AgeComparatorResult
{
    /** @var Person */
    public $person_one;

    /** @var Person */
    public $person_two;

    /** @var int */
    public $age_difference;

    public function __construct(
        Person $a_person_one,
        Person $a_person_two
    ) {
        $this->person_one = $a_person_one;
        $this->person_two = $a_person_two;

        $this->calculatedAgeDifference();
    }

    private function calculatedAgeDifference(): void
    {
        $this->age_difference = $this->person_two->birthDate()->getTimestamp()
            - $this->person_one->birthDate()->getTimestamp();
    }
}
