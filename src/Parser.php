<?php
/**
 * Parses mixed format string in to an array of key value pairs.
 * @file Parser
 */
namespace App;

class Parser
{

    public function parse(string $str) : array
    {
        $tokens = self::tokenise($str);
        return array(
            [
                'title'      => $tokens[0],
                'first_name' => $tokens[1],
                'initial'    => null,
                'last_name'  => end($tokens),
            ],
        );
    }

    protected static function tokenise(string $str) : array
    {
        return preg_split('/[\ \n\r\,\.]+/', $str, -1, PREG_SPLIT_NO_EMPTY);
    }
}
