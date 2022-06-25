<?php
/**
 * Loads file in to a CSV SplFileObject.
 * @file Loader
 */
namespace App;

use \SplFileObject;

class Loader
{

    protected $file;

    /**
     * @param {string} $filepath - filepath
     */
    public function getFile(string $filepath) : SplFileObject
    {
        try {
            $fileObj = new SplFileObject($filepath, "r", true);
            $fileObj->setFlags(SplFileObject::READ_CSV
                | SplFileObject::SKIP_EMPTY
                | SplFileObject::READ_AHEAD
                | SplFileObject::DROP_NEW_LINE);
            $fileObj->setCsvControl(',');
            return $fileObj;
        } catch (\Exception $e) {
            throw new \Exception('File not found.');
        }
    }
}
