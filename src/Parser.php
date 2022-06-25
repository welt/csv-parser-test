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
        $result = [];
        if (self::isTitleCouple($tokens)) {
            $result[] = $this->renderPerson($tokens[0], null, null, end($tokens));
            $result[] = $this->renderPerson($tokens[2], null, null, end($tokens));
        } else {
            $result[] = $this->renderPerson($tokens[0], $tokens[1], null, end($tokens));
        }
        return $result;
    }

    protected function renderPerson(
        ?string $title,
        ?string $first_name,
        ?string $initial,
        string $last_name
    ) : array {
            return array(
                'title'      => $title,
                'first_name' => $first_name,
                'initial'    => $initial,
                'last_name'  => $last_name,
            );
    }

    protected static function tokenise(string $str) : array
    {
        return preg_split('/[\ \n\r\,\.]+/', $str, -1, PREG_SPLIT_NO_EMPTY);
    }

    protected static function isCouple(array $arr) : bool
    {
        $conjunctionWords = ['and', '&'];
        return $arr !== array_diff($arr, $conjunctionWords);
    }

    protected static function isTitleCouple(array $arr) : bool
    {
        $honorificWords = ['Dr', 'Miss', 'Mr', 'Mister', 'Mrs', 'Prof'];
        return self::isCouple($arr) && $arr !== array_diff($arr, $honorificWords);
    }
}
