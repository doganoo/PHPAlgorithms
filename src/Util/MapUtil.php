<?php
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

namespace doganoo\PHPAlgorithms\Util;

use doganoo\PHPAlgorithms\Exception\InvalidKeyTypeException;

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

    public static function normalizeKey($key): int {
        /* ensuring that the key is an integer.
         * Therefore, some helper methods convert the key if
         * necessary.
         */
        if (\is_object($key)) {
            $objectString = MapUtil::objectToString($key);
            $key = MapUtil::stringToKey($objectString);
        } else if (\is_array($key)) {
            $arrayString = MapUtil::arrayToKey($key);
            $key = MapUtil::stringToKey($arrayString);
        } else if (\is_double($key)) {
            $key = MapUtil::doubleToKey($key);
        } else if (\is_float($key)) {
            $key = MapUtil::doubleToKey(\doubleval($key));
        } else if (\is_bool($key)) {
            $key = MapUtil::booleanToKey($key);
        } else if (\is_resource($key) || $key === null) {
            $key = MapUtil::booleanToKey(true);
        }
        return $key;
    }

    public static function objectToString($object): string {
        //TODO do type hinting when possible
        if (!\is_object($object)) {
            throw new InvalidKeyTypeException("key has to be an object, " . \gettype($object) . "given");
        }
        $string = "";
        $reflection = new \ReflectionClass($object);
        $methods = $reflection->getMethods();
        $properties = $reflection->getProperties();

        /** @var \ReflectionMethod $method */
        foreach ($methods as $method) {
            $string .= $method->getName();
        }
        /** @var \ReflectionProperty $property */
        foreach ($properties as $property) {
            $string .= $property->getName() . $property->getValue();
        }
        return $reflection->getName() . $string;
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
        for ($i = 0; $i < \strlen($string); $i++) {
            $char = $string[$i];
            $key += \ord($char);
        }
        return $key;
    }

    public static function arrayToKey(array $array): string {
        $result = "";
        \array_walk_recursive($array, function ($key, $value) use (&$result) {
            $result .= $key . $value;
        });
        return $result;
    }

    public static function doubleToKey(double $double): int {
        return \ceil($double);
    }

    public static function booleanToKey(bool $bool): int {
        return $bool ? 1 : 0;
    }
}