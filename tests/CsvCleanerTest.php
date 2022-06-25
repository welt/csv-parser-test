<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use \App\Loader;
use \App\Parser;
use \App\CsvCleaner;

class CsvCleanerTest extends TestCase
{

    public function test_it_should_return_an_array()
    {
        $csvCleaner = CsvCleaner::factory(new Loader(), new Parser());
        $result     = $csvCleaner->getPeople();

        $this->assertIsArray($result);
    }

    public function test_it_should_load_a_file()
    {
        $filepath   = 'tests/data/csv/examples__284_29.csv';
        $csvCleaner = CsvCleaner::factory(new Loader(), new Parser());
        $result     = $csvCleaner->setFile($filepath);
        $expected   = true;

        $this->assertEquals($expected, $result);
    }

    public function test_it_should_generate_one_person()
    {
        $filepath   = 'tests/data/csv/examples__single.csv';
        $csvCleaner = CsvCleaner::factory(new Loader(), new Parser());
        $csvCleaner->setFile($filepath);
        $result   = $csvCleaner->getPeople();
        $expected = array(
            [
                'title'      => 'Mr',
                'first_name' => 'John',
                'initial'    => null,
                'last_name'  => 'Smith',
            ]
        );

        $this->assertEquals($expected, $result);
    }

    public function test_it_should_generate_two_people()
    {
        $filepath   = 'tests/data/csv/examples__two.csv';
        $csvCleaner = CsvCleaner::factory(new Loader(), new Parser());
        $csvCleaner->setFile($filepath);
        $result   = $csvCleaner->getPeople();
        $expected = array(
            [
                'title'      => 'Mr',
                'first_name' => 'Tom',
                'initial'    => null,
                'last_name'  => 'Staff',
            ],
            [
                'title'      => 'Mr',
                'first_name' => 'John',
                'initial'    => null,
                'last_name'  => 'Doe',
            ]
        );

        $this->assertEquals($expected, $result);
    }

    public function test_it_should_generate_four_people()
    {
        $filepath   = 'tests/data/csv/examples__four.csv';
        $csvCleaner = CsvCleaner::factory(new Loader(), new Parser());
        $csvCleaner->setFile($filepath);
        $result   = $csvCleaner->getPeople();
        $expected = array(
            [
                'title'      => 'Mr',
                'first_name' => 'Tom',
                'initial'    => null,
                'last_name'  => 'Staff',
            ],
            [
                'title'      => 'Mr',
                'first_name' => 'John',
                'initial'    => null,
                'last_name'  => 'Doe',
            ],
            [
                'title'      => 'Dr',
                'first_name' => 'Joe',
                'initial'    => null,
                'last_name'  => 'Bloggs',
            ],
            [
                'title'      => 'Mrs',
                'first_name' => 'Joe',
                'initial'    => null,
                'last_name'  => 'Bloggs',
            ]
        );

        $this->assertEquals($expected, $result);
    }

    public function test_it_should_generate_eighteen_people()
    {
        $filepath   = 'tests/data/csv/examples__284_29.csv';
        $csvCleaner = CsvCleaner::factory(new Loader(), new Parser());
        $csvCleaner->setFile($filepath);
        $result = $csvCleaner->getPeople();

        $this->assertCount(18, $result);
    }
}
