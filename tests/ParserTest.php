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

    public function test_it_should_parse_title_couple()
    {
        $parser   = new Parser();
        $result   = $parser->parse('Mr and Mrs Smith');
        $expected = array(
            [
                'title'      => 'Mr',
                'first_name' => null,
                'initial'    => null,
                'last_name'  => 'Smith',
            ],
            [
                'title'      => 'Mrs',
                'first_name' => null,
                'initial'    => null,
                'last_name'  => 'Smith',
            ],
        );
        $this->assertEquals($expected, $result);
    }

    public function test_it_should_parse_old_style_couple()
    {
        $parser   = new Parser();
        $result   = $parser->parse('Dr & Mrs Joe Bloggs');
        $expected = array(
            [
                'title'       => 'Dr',
                'first_name'  => 'Joe',
                'initial'     => null,
                'last_name'   => 'Bloggs',
            ],
            [
                'title'       => 'Mrs',
                'first_name'  => 'Joe',
                'initial'     => null,
                'last_name'   => 'Bloggs',
            ],
        );
        $this->assertEquals($expected, $result);
    }
}
