<?php
namespace App;

interface ParserInterface
{
    public function parse(string $str) : array;
}
