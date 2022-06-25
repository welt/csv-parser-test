<?php
/**
 * Cleans & parses a CSV file to genrate an array of person arrays
 * from mixed format strings in cell column one.
 * @file CsvCleaner
 */
namespace App;

const COLUMN_HEADER = 'homeowner';

class CsvCleaner
{

    protected $file = array();

    protected $loader;

    protected $parser;

    public static function factory(Loader $loader, Parser $parser) : CsvCleaner
    {
        return new CsvCleaner($loader, $parser);
    }

    private function __construct(Loader $loader, Parser $parser)
    {
        $this->loader = $loader;
        $this->parser = $parser;
    }

    public function getPeople()
    {
        $result = array();
        foreach ($this->file as $row) {
            [$firstCell] = $row;
            if ($firstCell !== COLUMN_HEADER) {
                $result[] = $this->parser->parse($firstCell);
            }
        }

        return array_reduce($result, function ($accumulator, $group) {
            foreach ($group as $person) {
                $accumulator[] = $person;
            }
            return $accumulator;
        }, []);
    }

    public function setFile(string $filepath) : bool
    {
        try {
            $this->file = $this->loader->getFile($filepath);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}
