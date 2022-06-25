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
}
