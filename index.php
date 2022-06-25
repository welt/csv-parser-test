<?php
namespace App;

require 'vendor/autoload.php';

$csvCleaner = CsvCleaner::factory(new Loader(), new Parser());
$csvCleaner->setFile('data/csv/examples__284_29.csv');

echo '<pre>';
print_r($csvCleaner->getPeople());
echo '</pre>';
