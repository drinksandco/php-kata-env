<?php

declare(strict_types = 1);

namespace KataTest\Unit\Algorithm;

use Kata\Algorithm\Finder;
use Kata\Algorithm\FT;
use Kata\Algorithm\User;
use PHPUnit\Framework\TestCase;

final class FinderTest extends TestCase
{
    /** @var User */
    private $sue;

    /** @var User */
    private $greg;

    /** @var User */
    private $sarah;

    /** @var User */
    private $mike;

    protected function setUp()
    {
        $this->sue            = new User();
        $this->sue->name      = "Sue";
        $this->sue->birthDate = new \DateTime("1950-01-01");

        $this->greg            = new User();
        $this->greg->name      = "Greg";
        $this->greg->birthDate = new \DateTime("1952-05-01");

        $this->sarah            = new User();
        $this->sarah->name      = "Sarah";
        $this->sarah->birthDate = new \DateTime("1982-01-01");

        $this->mike            = new User();
        $this->mike->name      = "Mike";
        $this->mike->birthDate = new \DateTime("1979-01-01");
    }

    /** @test */
    public function should_return_empty_when_given_empty_list()
    {
        $users   = [];
        $finder = new Finder($users);

        $result = $finder->find(FT::ONE);

        $this->assertEquals(null, $result->p1);
        $this->assertEquals(null, $result->p2);
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $users   = [];
        $users[] = $this->sue;
        $finder = new Finder($users);

        $result = $finder->find(FT::ONE);

        $this->assertEquals(null, $result->p1);
        $this->assertEquals(null, $result->p2);
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $users   = [];
        $users[] = $this->sue;
        $users[] = $this->greg;
        $finder = new Finder($users);

        $result = $finder->find(FT::ONE);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->greg, $result->p2);
    }

    /** @test */
    public function should_return_furthest_two_for_two_people()
    {
        $users   = [];
        $users[] = $this->mike;
        $users[] = $this->greg;
        $finder = new Finder($users);

        $result = $finder->find(FT::TWO);

        $this->assertEquals($this->greg, $result->p1);
        $this->assertEquals($this->mike, $result->p2);
    }

    /** @test */
    public function should_return_furthest_two_for_four_people()
    {
        $users   = [];
        $users[] = $this->sue;
        $users[] = $this->sarah;
        $users[] = $this->mike;
        $users[] = $this->greg;
        $finder = new Finder($users);

        $result = $finder->find(FT::TWO);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->sarah, $result->p2);
    }

    /**
     * @test
     */
    public function should_return_closest_two_for_four_people()
    {
        $users   = [];
        $users[] = $this->sue;
        $users[] = $this->sarah;
        $users[] = $this->mike;
        $users[] = $this->greg;
        $finder = new Finder($users);

        $result = $finder->find(FT::ONE);

        $this->assertEquals($this->sue, $result->p1);
        $this->assertEquals($this->greg, $result->p2);
    }
}
