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

namespace doganoo\PHPAlgorithms\Algorithm\Various;

use doganoo\PHPUtil\Util\NumberUtil;
use doganoo\PHPUtil\Util\StringUtil;
use function array_merge;
use function array_slice;
use function count;
use function settype;
use function strlen;

/**
 * Class Permutation
 *
 * @package doganoo\PHPAlgorithms\Algorithm\Various
 */
class Permutation {

    /**
     * returns all permutations of a given string
     *
     * @param string $string
     * @return array
     */
    public function stringPermutations(string $string): array {
        $result = [];
        $strLen = strlen($string);
        if (0 === $strLen) {
            return $result;
        }
        if (1 === $strLen) {
            $result[] = $string;
            return $result;
        }
        $array = StringUtil::stringToArray($string);

        return $this->permute($array, "", $result);
    }

    /**
     * returns all permutations of an given array of objects
     *
     * @param array        $objects
     * @param              $prefix
     * @param array        $result
     * @return array
     */
    private function permute(array $objects, $prefix, array $result): array {
        $length = count($objects);
        //if there are no elements in the array,
        //a permutation is found. The permutation is
        //added to the array
        if (0 === $length) {
            $result[] = $prefix;
            return $result;
        }
        //if the number of elements in the array
        //is greater than 0, there are more elements
        //to build an permutation.
        // --------------------------------
        //The length is decreased by each recursive function call
        for ($i = 0; $i < $length; $i++) {
            //new object in order to create the new prefix
            $object = $objects[$i];

            //a new prefix is created. The prefix consists of the
            //actual prefix ("" at the beginning) and the next element
            //in the objects array
            $newPrefix = $prefix . $object;

            //since the ith element in objects is used as a prefix,
            //the remaining objects have to be sliced by exactly this
            //object in order to prevent a reoccurrence of the element in
            //the permutation
            $newObjects = array_merge(
                array_slice($objects, 0, $i),
                array_slice($objects, $i + 1)
            );

            //call the permute method with the new prefix and objects
            $result = $this->permute($newObjects, $newPrefix, $result);
        }
        return $result;
    }

    /**
     * returns all permutations of a given string
     *
     * @param int $number
     * @return array
     */
    public function numberPermutations(int $number): array {
        $result = [];
        $array  = NumberUtil::intToArray($number);
        $result = $this->permute($array, "", $result);
        foreach ($result as &$item) {
            settype($item, "integer");
        }
        return $result;
    }

}
