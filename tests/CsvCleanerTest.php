<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use \App\Loader;
use \App\CsvCleaner;

class CsvCleanerTest extends TestCase
{

    public function test_it_should_return_an_array()
    {
        $csvCleaner = CsvCleaner::factory(new Loader());
        $result     = $csvCleaner->getPeople();

        $this->assertIsArray($result);
    }

    public function test_it_should_load_a_file()
    {
        $filepath   = 'tests/data/csv/examples__284_29.csv';
        $csvCleaner = CsvCleaner::factory(new Loader());
        $result     = $csvCleaner->setFile($filepath);
        $expected   = true;

        $this->assertEquals($expected, $result);
    }
}
