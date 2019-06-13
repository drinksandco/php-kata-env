<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

use DateTimeImmutable;

final class Person
{
    /** @var string */
    private $name;

    /** @var DateTimeImmutable */
    private $birthDate;

    public function __construct(
        string $a_name,
        DateTimeImmutable $a_birthDate
    ) {
        $this->name = $a_name;
        $this->birthDate = $a_birthDate;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function birthDate(): DateTimeImmutable
    {
        return $this->birthDate;
    }
}
