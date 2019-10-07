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

namespace doganoo\PHPAlgorithmsTest\Sorting;

use doganoo\PHPAlgorithms\Algorithm\Sorting\BubbleSort;
use doganoo\PHPAlgorithms\Algorithm\Sorting\InsertionSort;
use doganoo\PHPAlgorithms\Algorithm\Sorting\MergeSort;
use doganoo\PHPAlgorithms\Algorithm\Sorting\QuickSort;
use doganoo\PHPAlgorithms\Algorithm\Sorting\RadixSort;
use doganoo\PHPAlgorithms\Algorithm\Sorting\SelectionSort;
use doganoo\PHPAlgorithms\Algorithm\Sorting\TimSort;
use PHPUnit\Framework\TestCase;

/**
 * Class SortTest
 */
class SortTest extends TestCase {
    public function testBubbleSort() {
        $bubbleSort = new BubbleSort();
        $result = $bubbleSort->sort([12, 40, 9, 55, 1, 13]);
        $this->assertTrue($result === [1, 9, 12, 13, 40, 55]);

        $result = $bubbleSort->sort([]);
        $this->assertTrue($result === []);

        $result = $bubbleSort->sort([9]);
        $this->assertTrue($result === [9]);
    }

    public function testSelectionSort() {
        $selectionSort = new SelectionSort();
        $result = $selectionSort->sort([12, 40, 9, 55, 1, 13]);
        $this->assertTrue($result === [1, 9, 12, 13, 40, 55]);

        $result = $selectionSort->sort([]);
        $this->assertTrue($result === []);

        $result = $selectionSort->sort([9]);
        $this->assertTrue($result === [9]);
    }

    public function testMergeSort() {
        $mergeSort = new MergeSort();
        $arr = [12, 40, 9, 55, 1, 13];
        $result = $mergeSort->sort($arr);
        $this->assertTrue($result === [1, 9, 12, 13, 40, 55]);

        $result = $mergeSort->sort([]);
        $this->assertTrue($result === []);

        $result = $mergeSort->sort([9]);
        $this->assertTrue($result === [9]);
    }

    public function testInsertionSort() {
        $insertionSort = new InsertionSort();
        $arr = [12, 40, 9, 55, 1, 13];
        $result = $insertionSort->sort($arr);
        $this->assertTrue($result === [1, 9, 12, 13, 40, 55]);

        $result = $insertionSort->sort([]);
        $this->assertTrue($result === []);

        $result = $insertionSort->sort([9]);
        $this->assertTrue($result === [9]);
    }

    public function testTimSort() {

        $timSort = new TimSort();
        $arr = [12, 40, 9, 55, 1, 13];
        $result = $timSort->sort($arr);
        $this->assertTrue($result === [1, 9, 12, 13, 40, 55]);

        $arr = [5, 21, 7, 23, 19];
        $result = $timSort->sort($arr);
        $this->assertTrue($result === [5, 7, 19, 21, 23]);

        $arr = [2, 3, 1, 5, 6, 7];
        $result = $timSort->sort($arr);
        $this->assertTrue($result === [1, 2, 3, 5, 6, 7]);

        $arr = [];
        $result = $timSort->sort($arr);
        $this->assertTrue($result === []);

        $arr = [1];
        $result = $timSort->sort($arr);
        $this->assertTrue($result === [1]);
    }

    public function testQuickSort() {
        $quickSort = new QuickSort();
        $arr = [12, 40, 9, 55, 1, 13];
        $result = $quickSort->sort($arr);
        $this->assertTrue($result === [1, 9, 12, 13, 40, 55]);

        $arr = [5, 21, 7, 23, 19];
        $result = $quickSort->sort($arr);
        $this->assertTrue($result === [5, 7, 19, 21, 23]);

        $arr = [2, 3, 1, 5, 6, 7];
        $result = $quickSort->sort($arr);
        $this->assertTrue($result === [1, 2, 3, 5, 6, 7]);

        $arr = [];
        $result = $quickSort->sort($arr);
        $this->assertTrue($result === []);

        $arr = [1];
        $result = $quickSort->sort($arr);
        $this->assertTrue($result === [1]);
    }

    public function testRadixSort() {
        $radixSort = new RadixSort();
        $result = $radixSort->sort([12, 40, 9, 55, 1, 13]);
        $this->assertTrue($result === [1, 9, 12, 13, 40, 55]);

        $result = $radixSort->sort([]);
        $this->assertTrue($result === []);

        $result = $radixSort->sort([9]);
        $this->assertTrue($result === [9]);
    }
}