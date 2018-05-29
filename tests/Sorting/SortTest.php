<?php


use doganoo\PHPAlgorithms\Algorithm\Sorting\BubbleSort;
use doganoo\PHPAlgorithms\Algorithm\Sorting\MergeSort;
use doganoo\PHPAlgorithms\algorithm\sorting\SelectionSort;

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
}