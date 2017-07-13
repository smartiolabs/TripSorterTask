<?php

// Define path to source directory
defined('SOURCE_FILE_PATH')
|| define('SOURCE_FILE_PATH', __DIR__ . '/sourcefile/');

// Composer autoload
require_once __DIR__ . '/vendor/autoload.php';

// Load Json Parser
$sourceFile = SOURCE_FILE_PATH . 'cards.json';
$JsonParser = new src\Parser\Reader\Json();
$tripCollection = $JsonParser->fromFile($sourceFile);

// Load TripSorter
use src\TripSorter\TripSorter;

$tripSorter = new TripSorter($tripCollection);
$transportation = $tripSorter->sort()->getTransportation();

if ($count = count($transportation)) {
    echo 'Source File : ' . $sourceFile . PHP_EOL;
    foreach ($transportation as $index => $type) {
        echo $type->getMessage() . PHP_EOL;

        if($index == $count - 1)
            echo $type::MESSAGE_FINAL_DESTINATION . PHP_EOL;
    }
}
