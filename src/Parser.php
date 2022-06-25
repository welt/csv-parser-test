<?php
/**
 * Parses mixed format string in to an array of key value pairs.
 * @file Parser
 */
namespace App;

class Parser implements ParserInterface
{

    public function parse(string $str) : array
    {
        $tokens = self::tokenise($str);
        $result = [];
        if (self::isTwoTitleCouple($tokens)) {
            $result[] = $this->renderPerson($tokens[0], $tokens[1], $tokens[2]);
            $result[] = $this->renderPerson($tokens[4], $tokens[5], end($tokens));
        } elseif (self::isOldStyleCouple($tokens)) {
            $result[] = $this->renderPerson($tokens[0], $tokens[3], end($tokens));
            $result[] = $this->renderPerson($tokens[2], $tokens[3], end($tokens));
        } elseif (self::isTitleCouple($tokens)) {
            $result[] = $this->renderPerson($tokens[0], null, end($tokens));
            $result[] = $this->renderPerson($tokens[2], null, end($tokens));
        } else {
            $result[] = $this->renderPerson($tokens[0], $tokens[1], end($tokens));
        }
        return $result;
    }

    protected function renderPerson(
        ?string $title,
        ?string $nameOrInitial,
        string $last_name
    ) : array {
            return array(
                'title'      => $title,
                'first_name' => self::isAnInitial($nameOrInitial) ? null : $nameOrInitial,
                'initial'    => self::isAnInitial($nameOrInitial) ? $nameOrInitial : null,
                'last_name'  => $last_name,
            );
    }

    protected static function tokenise(string $str) : array
    {
        return preg_split('/[\ \n\r\,\.]+/', $str, -1, PREG_SPLIT_NO_EMPTY);
    }

    protected static function isCouple(array $arr) : bool
    {
        // If any token is a conjunction, then it's a couple.
        $conjunctionWords = ['and', '&'];
        return $arr !== array_diff($arr, $conjunctionWords);
    }

    protected static function isTitleCouple(array $arr) : bool
    {
        // If it's a couple and there are honorifics.
        $honorificWords = ['Dr', 'Miss', 'Mr', 'Mister', 'Mrs', 'Prof'];
        return self::isCouple($arr) && $arr !== array_diff($arr, $honorificWords);
    }

    protected static function isOldStyleCouple(array $arr) : bool
    {
        // If it's a couple and there's a conjunction in the first three tokens.
        $pruned = array_slice($arr, 0, 3);
        return self::isCouple($pruned) && end($arr) !== $arr[3];
    }

    protected static function isTwoTitleCouple(array $arr) : bool
    {
        // If it's a couple and there are seven tokens.
        return self::isCouple($arr) && count($arr) === 7;
    }

    protected static function isAnInitial(?string $str) : bool
    {
        if ($str === null) {
            return false;
        }
        // If it's a single character and it's a letter.
        $cleaned = preg_replace('/[^a-z]+/i', '', $str);
        return preg_match_all('/\w/u', $cleaned) === 1;
    }
}
