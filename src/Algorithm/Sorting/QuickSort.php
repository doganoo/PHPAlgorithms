<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar
 *
 * @author Alexey Berezuev <alexey@berezuev.ru>
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
use function array_values;
use function count;

/**
 * Class QuickSort
 *
 * @package doganoo\PHPAlgorithms\Sorting
 */
class QuickSort implements ISortable {

    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array): array {
        $this->quickSort($array, 0, count($array) - 1);
        return $array;
    }

    private function quickSort(array &$array, int $left, int $right): void {
        if ($left >= $right) {
            return;
        }
        $pivotIndex = $this->partition($array, $left, $right);
        $this->quicksort($array, $left, $pivotIndex - 1);
        $this->quicksort($array, $pivotIndex, $right);
    }

    private function partition(array &$array, int $left, int $right): int {
        $pivotIndex = floor(($right + $left) / 2);
        $pivot      = $array[$pivotIndex];
        while ($left <= $right) {
            while (Comparator::lessThan($array[$left], $pivot)) {
                $left++;
            }
            while (Comparator::greaterThan($array[$right], $pivot)) {
                $right--;
            }
            if ($left <= $right) {
                $temp          = $array[$left];
                $array[$left]  = $array[$right];
                $array[$right] = $temp;
                $left++;
                $right--;
            }
        }
        return $left;
    }

}