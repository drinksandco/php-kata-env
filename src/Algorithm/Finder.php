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

    public function find(int $orderMode): UsersBirthDateDifference
    {
        /** @var UsersBirthDateDifference[] $usersBirthDateDifferenceList */
        $usersBirthDateDifferenceList = [];
        $totalUsers = count($this->users);

        for ($i = 0; $i < $totalUsers; $i++) {
            for ($j = $i + 1; $j < $totalUsers; $j++) {
                $usersBirthDateDifference = new UsersBirthDateDifference();

                if ($this->users[$i]->birthDate < $this->users[$j]->birthDate) {
                    $usersBirthDateDifference->youngerUser = $this->users[$i];
                    $usersBirthDateDifference->olderUser = $this->users[$j];
                } else {
                    $usersBirthDateDifference->youngerUser = $this->users[$j];
                    $usersBirthDateDifference->olderUser = $this->users[$i];
                }

                $usersBirthDateDifference->dateDifference = $usersBirthDateDifference->olderUser->birthDate->getTimestamp()
                    - $usersBirthDateDifference->youngerUser->birthDate->getTimestamp();

                $usersBirthDateDifferenceList[] = $usersBirthDateDifference;
            }
        }

        if (count($usersBirthDateDifferenceList) < 1) {
            return new UsersBirthDateDifference();
        }

        return $this->orderByAgeDifference($orderMode, $usersBirthDateDifferenceList);
    }

    /**
     *
     *
     * @param int $orderMode
     * @param UsersBirthDateDifference[] $usersBirthDateDifferenceList
     * @return UsersBirthDateDifference
     */
    private function orderByAgeDifference(int $orderMode, array $usersBirthDateDifferenceList): UsersBirthDateDifference
    {
        $answer = $usersBirthDateDifferenceList[0];

        foreach ($usersBirthDateDifferenceList as $result) {
            switch ($orderMode) {
                case BirthDateDifference::SHORTEST:
                    if ($result->dateDifference < $answer->dateDifference) {
                        $answer = $result;
                    }
                    break;

                case BirthDateDifference::LONGEST:
                    if ($result->dateDifference > $answer->dateDifference) {
                        $answer = $result;
                    }
                    break;
            }
        }
        return $answer;
    }
}
