<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

use DateTime;

final class Person
{
    /** @var string */
    private $name;

    /** @var DateTime */
    private $birthDate;

    public function __construct(string $name, string $birthDate)
    {
        $this->name = $name;
        $this->birthDate = new DateTime($birthDate);
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
