<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace doganoo\PHPAlgorithms\Common\Util;

use doganoo\PHPAlgorithms\Common\Exception\InvalidKeyTypeException;
use doganoo\PHPAlgorithms\Common\Exception\UnsupportedKeyTypeException;
use doganoo\PHPAlgorithms\Common\Interfaces\IHashable;
use function array_walk_recursive;
use function ceil;
use function doubleval;
use function gettype;
use function is_array;
use function is_bool;
use function is_double;
use function is_float;
use function is_int;
use function is_object;
use function is_resource;
use function is_string;
use function json_encode;
use function ord;
use function serialize;
use function strlen;
use function unserialize;

/**
 * Class Util
 *
 * @package doganoo\PHPAlgorithms\Util
 */
class MapUtil {

    /**
     * private constructor in order to prevent instantiation
     */
    private function __construct() {

    }

    /**
     * normalizes a given key to a int. This method converts currently the following
     * types to a int:
     *
     * <ul>objects</ul>
     * <ul>arrays</ul>
     * <ul>doubles</ul>
     * <ul>floats</ul>
     * <ul>boolean</ul>
     * <ul>resource|null</ul>
     * <ul>int</ul>
     *
     * @param $key
     * @return int
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    public static function normalizeKey($key): int {
        /* ensuring that the key is an integer.
         * Therefore, some helper methods convert the key if
         * necessary.
         */
        if (is_string($key)) {
            $key = MapUtil::stringToKey($key);
        } else if ($key instanceof IHashable) {
            $key = $key->getHash();
            $key = MapUtil::stringToKey($key);
        } else if (is_object($key) && !($key instanceof IHashable)) {
            $objectString = MapUtil::objectToString($key);
            $key          = MapUtil::stringToKey($objectString);
        } else if (is_array($key)) {
            $arrayString = MapUtil::arrayToKey($key);
            $key         = MapUtil::stringToKey($arrayString);
        } else if (is_double($key)) {
            $key = MapUtil::doubleToKey($key);
        } else if (is_float($key)) {
            $key = MapUtil::doubleToKey(doubleval($key));
        } else if (is_bool($key)) {
            $key = MapUtil::booleanToKey($key);
        } else if (is_resource($key) || $key === null) {
            $key = MapUtil::booleanToKey(true);
        } else if (is_int($key)) {
            return $key;
        } else {
            throw new UnsupportedKeyTypeException();
        }
        return $key;
    }

    /**
     * converts a string to a hash map key by summing all
     * ASCII values of each character.
     *
     * @param string $string
     * @return int
     */
    public static function stringToKey(string $string): int {
        $key = 0;
        for ($i = 0; $i < strlen($string); $i++) {
            $char = $string[$i];
            $key  += ord($char);
        }
        return $key;
    }

    /**
     * This methods converts an object to a string using serialization
     *
     * @param $object
     * @return string
     * @throws InvalidKeyTypeException
     */
    public static function objectToString($object): string {
        //TODO do type hinting when possible
        if (!is_object($object)) {
            throw new InvalidKeyTypeException("key has to be an object, " . gettype($object) . "given");
        }
        return spl_object_hash($object);
    }

    /**
     * converts an array to a valid key for HashMap
     *
     * @param array $array
     * @return string
     */
    public static function arrayToKey(array $array): string {
        $result = "";
        array_walk_recursive($array, function ($key, $value) use (&$result) {
            $result .= $key . $value;
        });
        return $result;
    }

    /**
     * converts a double to a HashMap Key
     *
     * @param float $double
     * @return int
     */
    public static function doubleToKey(float $double): int {
        return (int) ceil($double);
    }

    /**
     * converts a boolean to a HashMap key
     *
     * @param bool $bool
     * @return int
     */
    public static function booleanToKey(bool $bool): int {
        return $bool ? 1 : 0;
    }

    /**
     * normalizes a given key to a int. This method converts currently the following
     * types to a int:
     *
     * <ul>objects</ul>
     * <ul>arrays</ul>
     * <ul>doubles</ul>
     * <ul>floats</ul>
     * <ul>boolean</ul>
     * <ul>resource|null</ul>
     * <ul>int</ul>
     *
     * @param $value
     * @return string
     * @throws UnsupportedKeyTypeException
     */
    public static function normalizeValue($value): string {
        /* ensuring that the key is an integer.
         * Therefore, some helper methods convert the key if
         * necessary.
         */
        if (is_object($value)) {
            $value = serialize($value);
        } else if (is_array($value)) {
            $value = json_encode($value);
        } else if (is_double($value)) {
            $value = (string) $value;
        } else if (is_float($value)) {
            $value = (string) $value;
        } else if (is_bool($value)) {
            $value = $value ? "true" : "false";
        } else if (is_resource($value) || $value === null) {
            //TODO resource/null
        } else if (is_int($value)) {
            return (string) $value;
        } else {
            throw new UnsupportedKeyTypeException();
        }
        return $value;
    }

    /**
     * @param string $string
     * @return mixed|null
     */
    public static function unserialize(string $string) {
        if (self::isSerialized($string)) {
            return unserialize($string);
        }
        return null;
    }

    /**
     * Check if a string is serialized
     *
     * see: https://stackoverflow.com/a/4994515
     *
     * @param string $string
     * @return bool
     */
    public static function isSerialized(string $string): bool {
        return (@unserialize($string) !== false);
    }

}