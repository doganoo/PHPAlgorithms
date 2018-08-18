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


use doganoo\PHPAlgorithms\Algorithm\Sorting\BubbleSort;
use doganoo\PHPAlgorithms\Algorithm\Sorting\InsertionSort;
use doganoo\PHPAlgorithms\Algorithm\Sorting\MergeSort;
use doganoo\PHPAlgorithms\Algorithm\Sorting\SelectionSort;

/**
 * Class SortTest
 */
class SortTest extends \PHPUnit\Framework\TestCase {
    public function testBubbleSort() {
        $bubbleSort = new BubbleSort();
        $result = $bubbleSort->sort([12, 40, 9, 55, 1, 13]);
        $this->assertTrue($result === [1, 9, 12, 13, 40, 55]);
    }

    public function testSelectionSort() {
        $bubbleSort = new SelectionSort();
        $result = $bubbleSort->sort([12, 40, 9, 55, 1, 13]);
        $this->assertTrue($result === [1, 9, 12, 13, 40, 55]);
    }

    public function testMergeSort() {
        $bubbleSort = new MergeSort();
        $arr = [12, 40, 9, 55, 1, 13];
        $result = $bubbleSort->sort($arr);
        $this->assertTrue($result === [1, 9, 12, 13, 40, 55]);
    }
    public function testInsertionSort() {
        $bubbleSort = new InsertionSort();
        $arr = [12, 40, 9, 55, 1, 13];
        $result = $bubbleSort->sort($arr);
        $this->assertTrue($result === [1, 9, 12, 13, 40, 55]);
    }
}