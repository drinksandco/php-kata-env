<?php

declare(strict_types=1);

namespace KataTest\Unit\Algorithm;

use Kata\Algorithm\Finder;
use Kata\Algorithm\FT;
use Kata\Algorithm\Person;
use PHPUnit\Framework\TestCase;

final class FinderTest extends TestCase
{
    /** @var Person */
    private $sue;
    /** @var Person */
    private $greg;
    /** @var Person */
    private $sarah;
    /** @var Person */
    private $mike;

    protected function setUp()
    {
        $this->sue = new Person('Sue', '1950-01-01');
        $this->greg = new Person('Greg', '1952-05-01');
        $this->sarah = new Person('Sarah', '1982-01-01');
        $this->mike = new Person('Mike', '1979-01-01');
    }

    /** @test */
    public function should_return_empty_when_given_empty_list()
    {
        $people = [];
        $finder = new Finder($people);

        $result = $finder->find(FT::ONE);

        $this->assertEquals(null, $result->older_person);
        $this->assertEquals(null, $result->younger_person);
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $list = [];
        $list[] = $this->sue;
        $finder = new Finder($list);

        $result = $finder->find(FT::ONE);

        $this->assertEquals(null, $result->older_person);
        $this->assertEquals(null, $result->younger_person);
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $list = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(FT::ONE);

        $this->assertEquals($this->sue, $result->older_person);
        $this->assertEquals($this->greg, $result->younger_person);
    }

    /** @test */
    public function should_return_furthest_two_for_two_people()
    {
        $list = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(FT::TWO);

        $this->assertEquals($this->greg, $result->older_person);
        $this->assertEquals($this->mike, $result->younger_person);
    }

    /** @test */
    public function should_return_furthest_two_for_four_people()
    {
        $list = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(FT::TWO);

        $this->assertEquals($this->sue, $result->older_person);
        $this->assertEquals($this->sarah, $result->younger_person);
    }

    /**
     * @test
     */
    public function should_return_closest_two_for_four_people()
    {
        $list = [];
        $list[] = $this->sue;
        $list[] = $this->sarah;
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(FT::ONE);

        $this->assertEquals($this->sue, $result->older_person);
        $this->assertEquals($this->greg, $result->younger_person);
    }
}
