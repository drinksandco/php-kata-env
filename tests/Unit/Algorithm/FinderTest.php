<?php

declare(strict_types=1);

namespace KataTest\Unit\Algorithm;

use DateTimeImmutable;
use Kata\Algorithm\Criteria;
use Kata\Algorithm\Finder;
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
        $this->sue = new Person('Sue', new DateTimeImmutable('1950-01-01'));
        $this->greg = new Person('Greg', new DateTimeImmutable('1952-05-01'));
        $this->sarah = new Person('Sarah', new DateTimeImmutable('1982-01-01'));
        $this->mike = new Person('Mike', new DateTimeImmutable('1979-01-01'));
    }

    /** @test */
    public function should_return_empty_when_given_empty_list()
    {
        $list = [];
        $finder = new Finder($list);

        $result = $finder->find(Criteria::CLOSEST);

        $this->assertEquals(null, $result->person_one);
        $this->assertEquals(null, $result->person_two);
    }

    /** @test */
    public function should_return_empty_when_given_one_person()
    {
        $list = [];
        $list[] = $this->sue;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::CLOSEST);

        $this->assertEquals(null, $result->person_one);
        $this->assertEquals(null, $result->person_two);
    }

    /** @test */
    public function should_return_closest_two_for_two_people()
    {
        $list = [];
        $list[] = $this->sue;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::CLOSEST);

        $this->assertEquals($this->sue, $result->person_one);
        $this->assertEquals($this->greg, $result->person_two);
    }

    /** @test */
    public function should_return_furthest_two_for_two_people()
    {
        $list = [];
        $list[] = $this->mike;
        $list[] = $this->greg;
        $finder = new Finder($list);

        $result = $finder->find(Criteria::FURTHEST);

        $this->assertEquals($this->greg, $result->person_one);
        $this->assertEquals($this->mike, $result->person_two);
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

        $result = $finder->find(Criteria::FURTHEST);

        $this->assertEquals($this->sue, $result->person_one);
        $this->assertEquals($this->sarah, $result->person_two);
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

        $result = $finder->find(Criteria::CLOSEST);

        $this->assertEquals($this->sue, $result->person_one);
        $this->assertEquals($this->greg, $result->person_two);
    }
}
