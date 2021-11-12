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
use function array_fill;
use function count;
use function max;

/**
 * Class BucketSort
 *
 * @package doganoo\PHPAlgorithms\Algorithm\Sorting
 */
class BucketSort implements ISortable {

    /**
     * @param array $array
     * @return array
     */
    public function sort(array $array): array {
        if (empty($array)) {
            return [];
        }

        $size    = count($array);
        $max     = max($array);
        $buckets = array_fill(0, $size + 1, []);

        foreach ($array as $v) {
            $bucket = (int) ($size * $v / $max);
            $buckets[$bucket][] = $v;
        }

        $insertionSort = new InsertionSort();
        for ($i = 0; $i < $size; ++$i) {
            $buckets[$i] = $insertionSort->sort($buckets[$i]);
        }

        $sorted = [];
        foreach ($buckets as $bucket) {
            foreach ($bucket as $v) {
                $sorted[] = $v;
            }
        }

        return $sorted;
    }
}
