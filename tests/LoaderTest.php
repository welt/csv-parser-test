<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use App\Loader;

class LoaderTest extends TestCase
{
    public function test_it_loads_a_file()
    {
        $path   = 'tests/data/csv/examples__284_29.csv';
        $loader = new Loader();
        $result = $loader->getFile($path);

        $this->assertInstanceOf('\SplFileObject', $result);
    }
}
