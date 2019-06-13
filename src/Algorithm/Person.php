<?php

declare(strict_types=1);

namespace Kata\Algorithm;

use DateTime;

final class Person
{
    /** @var string */
    public $name;
    /** @var DateTime */
    public $birthDate;

    public function equals(self $person): bool
    {
        return $this->name === $person->name
            && $this->birthDate === $person->birthDate;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function getBirthDate(): DateTime
    {
        return $this->birthDate;
    }

    public function setBirthDate(DateTime $birthDate)
    {
        $this->birthDate = $birthDate;
    }
}
