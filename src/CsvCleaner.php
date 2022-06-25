<?php
/**
 * Parses mixed format string in to an array of key value pairs.
 * @file Parser
 */
namespace App;

class CsvCleaner
{

    protected $file = array();

    protected $loader;

    public function getPeople()
    {
        return array();
    }

    public function __construct(Loader $loader)
    {
        $this->loader = $loader;
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
