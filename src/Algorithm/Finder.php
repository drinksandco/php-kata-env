<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

final class Finder
{
    /** @var Person[] */
    private $_p;

    public function __construct(array $p)
    {
        $this->_p = $p;
    }

    public function find(int $ft): PeopleByAgeDifference
    {
        /** @var PeopleByAgeDifference[] $tr */
        $tr = [];

        for ($i = 0; $i < count($this->_p); $i++) {
            for ($j = $i + 1; $j < count($this->_p); $j++) {
                $r = new PeopleByAgeDifference();

                if ($this->_p[$i]->birthDate < $this->_p[$j]->birthDate) {
                    $r->firstPerson = $this->_p[$i];
                    $r->secondPerson = $this->_p[$j];
                } else {
                    $r->firstPerson = $this->_p[$j];
                    $r->secondPerson = $this->_p[$i];
                }

                $r->timeDifference = $r->secondPerson->birthDate->getTimestamp()
                    - $r->firstPerson->birthDate->getTimestamp();

                $tr[] = $r;
            }
        }

        if (count($tr) < 1) {
            return new PeopleByAgeDifference();
        }

        $answer = $tr[0];

        foreach ($tr as $result) {
            switch ($ft) {
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
}
