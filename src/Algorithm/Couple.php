<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

final class Couple
{
    /** @var Person */
    public $older_person;

    /** @var Person */
    public $younger_person;

    /** @var int */
    public $age_difference;

    public function __construct(
        ?Person $first_person = null,
        ?Person $second_person = null
    ) {
        if (null === $first_person || null === $second_person)
        {
            return;
        }

        $this->older_person = $this->getOlderPerson($first_person, $second_person);
        $this->younger_person = $this->getYoungerPerson($first_person, $second_person);
    }

    private function getOlderPerson(
        Person $first_person,
        Person $second_person
    ) {
        if ($first_person->getBirthDate() < $second_person->getBirthDate())
        {
            return $first_person;

        }

        return $second_person;
    }

    private function getYoungerPerson(
        Person $first_person,
        Person $second_person
    ) {
        if ($first_person->getBirthDate() < $second_person->getBirthDate())
        {
            return $second_person;
        }

        return $first_person;
    }
}
