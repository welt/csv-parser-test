<?php

namespace App;

use \SplFileObject;

interface LoaderInterface
{
    public function getFile(string $filepath) : SplFileObject;
}
