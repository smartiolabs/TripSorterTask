<?php

namespace src\Parser\Reader;

/**
 * Interface ReaderInterface
 *
 * @package src\Parser\Reader
 */
interface ReaderInterface
{

    /**
     * Read a string and create an array
     *
     * @param string $string
     *
     * @return array
     */
    public function fromString($string);

    /**
     * Read a file and create an array
     *
     * @param $filename
     *
     * @return array or bool
     */
    public function fromFile($filename);

}
