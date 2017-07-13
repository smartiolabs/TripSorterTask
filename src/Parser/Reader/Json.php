<?php

namespace src\Parser\Reader;

use src\Parser\Exception;

/**
 * Class Json
 *
 * @package src\Parser\Reader
 */
class Json implements ReaderInterface
{

    /**
     * When TYPE ARRAY is used the returned objects will be converted
     * into an associative arrays
     *
     * @var bool
     */
    const TYPE_ARRAY = 1;
    const TYPE_OBJECT = 0;

    /**
     * Read a string and create an array, defined in ReaderInterface
     *
     * @param string $jsonString json input
     *
     * @see ReaderInterface::fromString()
     *
     * @return array|bool
     *
     * @throws Exception\RuntimeException
     */
    public function fromString($jsonString)
    {
        if (empty($jsonString)) {
            return array();
        }

        try {
            return static::decode($jsonString);
        } catch (Exception\RuntimeException $e) {
            throw new Exception\RuntimeException($e->getMessage());
        }
    }

    /**
     * Read a file and create an array, defined in ReaderInterface
     *
     * @see ReaderInterface::fromFile()
     *
     * @param string $filename
     *
     * @return array
     * @throws Exception\RuntimeException
     */
    public function fromFile($filename)
    {
        if (!is_readable($filename) || !is_file($filename)) {
            throw new Exception\RuntimeException(
                'File %s is not readable',
                $filename
            );
        }

        try {
            return static::decode(file_get_contents($filename));
        } catch (Exception\RuntimeException $e) {
            throw new Exception\RuntimeException($e->getMessage());
        }
    }

    /**
     * Decodes the given encoded $json string
     *
     * @param string $json  encoded in JSON format
     * @param bool $toArray When TRUE, returned objects will be converted into associative arrays
     *                      returned objects will be converted into associative arrays
     *
     * @return mixed
     * @throws Exception\RuntimeException
     */
    public static function decode($json, $toArray = Json::TYPE_ARRAY)
    {
        $decode = json_decode($json, $toArray);

        switch (json_last_error()) {
            case JSON_ERROR_NONE:
                break;
            case JSON_ERROR_DEPTH:
                throw new Exception\RuntimeException('The maximum stack depth has been exceeded');
            case JSON_ERROR_STATE_MISMATCH:
                throw new Exception\RuntimeException('Invalid or malformed JSON');
            case JSON_ERROR_CTRL_CHAR:
                throw new Exception\RuntimeException('Control character error, possibly incorrectly encoded');
            case JSON_ERROR_SYNTAX:
                throw new Exception\RuntimeException('Syntax error');
            case JSON_ERROR_UTF8:
                throw new Exception\RuntimeException('Malformed UTF-8 characters, possibly incorrectly encoded');
            default:
                throw new Exception\RuntimeException('Decoding failed');
        }

        return $decode;

    }

    /**
     * Todo
     */
    public static function encode()
    {
    }
}
