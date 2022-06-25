<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

use App\Parser;

class ParserTest extends TestCase
{

    public function test_it_should_parse_one_person()
    {
        $parser   = new Parser();
        $result   = $parser->parse('Mrs Faye Hughes-Eastwood');
        $expected = array(
            [
                'title'      => 'Mrs',
                'first_name' => 'Faye',
                'initial'    => null,
                'last_name'  => 'Hughes-Eastwood',
            ]
        );

        $this->assertEquals($expected, $result);
    }
}
