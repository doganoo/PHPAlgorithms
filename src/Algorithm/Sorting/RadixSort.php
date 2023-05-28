<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar
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

namespace doganoo\PHPAlgorithms\Algorithm\Sorting;

use doganoo\PHPAlgorithms\Common\Interfaces\ISortable;
use doganoo\PHPAlgorithms\Common\Util\Comparator;

/**
 * Class RadixSort
 * @package doganoo\PHPAlgorithms\Algorithm\Sorting
 */
class RadixSort implements ISortable {

    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array): array {
        $n = count($array);
        if (0 === $n || 1 === $n) return $array;

        $max      = $this->getMax($array);
        $exponent = 1;

        while (Comparator::greaterThan($max / $exponent, 0)) {
            $this->countSort($array, $exponent);
            $exponent = $exponent * 10;
            $exponent = (int) $exponent;
        }

        return $array;
    }

    /**
     * @param array $array
     * @param int   $exponent
     */
    private function countSort(array &$array, int $exponent): void {
        $n      = count($array);
        $output = [];
        $count  = array_fill(0, 10, 0);

        for ($i = 0; $i < $n; $i++) {
            $count[(int) ($array[$i] / $exponent) % 10]++;
        }

        for ($i = 1; $i < 10; $i++) {
            $count[$i] += $count[$i - 1];
        }

        for ($i = $n - 1; $i >= 0; $i--) {
            $output[$count[(int) ($array[(int) $i] / $exponent) % 10] - 1] = $array[$i];
            $count[(int) ($array[(int) $i] / $exponent) % 10]--;
        }

        for ($i = 0; $i < $n; $i++) {
            $array[$i] = $output[$i];
        }
    }

    /**
     * @param array $array
     * @return int
     */
    private function getMax(array $array): int {
        $n = count($array);

        $max = $array[0];
        for ($i = 1; $i < $n; $i++) {
            if (Comparator::greaterThan($array[$i], $max)) {
                $max = $array[$i];
            }
        }
        return $max;
    }

}