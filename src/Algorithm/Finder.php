<?php

declare(strict_types = 1);

namespace Kata\Algorithm;

final class Finder
{
    /** @var User[] */
    private $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function find(int $ft): F
    {
        /** @var F[] $tr */
        $tr = [];

        for ($i = 0; $i < count($this->users); $i++) {
            for ($j = $i + 1; $j < count($this->users); $j++) {
                $r = new F();

                if ($this->users[$i]->birthDate < $this->users[$j]->birthDate) {
                    $r->p1 = $this->users[$i];
                    $r->p2 = $this->users[$j];
                } else {
                    $r->p1 = $this->users[$j];
                    $r->p2 = $this->users[$i];
                }

                $r->d = $r->p2->birthDate->getTimestamp()
                    - $r->p1->birthDate->getTimestamp();

                $tr[] = $r;
            }
        }

        if (count($tr) < 1) {
            return new F();
        }

        $answer = $tr[0];

        foreach ($tr as $result) {
            switch ($ft) {
                case FT::ONE:
                    if ($result->d < $answer->d) {
                        $answer = $result;
                    }
                    break;

                case FT::TWO:
                    if ($result->d > $answer->d) {
                        $answer = $result;
                    }
                    break;
            }
        }

        return $answer;
    }
}
