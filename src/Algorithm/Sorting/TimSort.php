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
use function array_merge;
use function array_slice;
use function array_values;
use function count;

/**
 * Class TimSort
 * @package doganoo\PHPAlgorithms\Algorithm\Sorting
 */
class TimSort implements ISortable {

    public const RUN = 32;

    public function __construct() {
        trigger_error(
            'Notice, the sorting algorithm seems to be broken, according to: https://github.com/doganoo/PHPAlgorithms/issues/23. Feel free to open a PR or use another sorting algorithm instead :)'
            , E_USER_WARNING
        );
    }

    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array): array {
        $array = array_values($array);
        $size  = count($array);

        if (0 === $size) return [];
        if (1 === $size) return $array;

        $insertionSort = new InsertionSort();
        $mergeSort     = new MergeSort();

        $result = [];
        for ($i = 0; $i < $size; $i = $i + self::RUN) {
            $arr    = $insertionSort->sort(array_slice($array, $i, min(($i + self::RUN), ($size))));
            $arr    = $mergeSort->sort($arr);
            $result = array_merge($result, $arr);
        }
        return $result;
    }

}