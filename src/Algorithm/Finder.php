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

        foreach ($this->users as $i => $user) {
            for ($j = $i + 1; $j < $totalUsers; $j++) {
                $usersBirthDateDifference = new UsersBirthDateDifference();

                if ($user->birthDate < $this->users[$j]->birthDate) {
                    $usersBirthDateDifference->youngerUser = $user;
                    $usersBirthDateDifference->olderUser = $this->users[$j];
                } else {
                    $usersBirthDateDifference->youngerUser = $this->users[$j];
                    $usersBirthDateDifference->olderUser = $user;
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
        usort($usersBirthDateDifferenceList, function(UsersBirthDateDifference $firstElement, UsersBirthDateDifference $secondElement) use ($orderMode) {
            if (BirthDateDifference::SHORTEST === $orderMode) {
                return $firstElement->dateDifference <=> $secondElement->dateDifference;
            }

            return $secondElement->dateDifference <=> $firstElement->dateDifference;
        });

        return current($usersBirthDateDifferenceList);
    }
}
