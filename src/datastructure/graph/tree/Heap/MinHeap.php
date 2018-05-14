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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree\Heap;

use doganoo\PHPAlgorithms\common\util\Comparator;
use doganoo\PHPUtil\Log\Logger;


/**
 * Class MinHeap
 *
 * see https://www.sanfoundry.com/java-program-implement-min-heap/
 *
 * @package doganoo\PHPAlgorithms\datastructure\graph\tree\Heap
 */
class MinHeap {
    /**
     * @var array|null $size the heap
     */
    private $heap = null;
    /**
     * @var int $maxSize the maximum size
     */
    private $maxSize = 128;

    /**
     * MinHeap constructor.
     */
    public function __construct() {
        $this->clear();
    }

    /**
     * resets the heap
     *
     * @return bool
     */
    public function clear(): bool {
        $this->heap = \array_fill(0, $this->maxSize, null);
        $this->heap[0] = \PHP_INT_MIN;
        return \count($this->heap) === 1 && $this->heap[0] === \PHP_INT_MIN;
    }

    /**
     * displays the heap
     */
    public function display() {
        for ($i = 1; $i <= $this->length() / 2; $i++) {
            $string = "Parent Node: " . $this->heap[$i] . " Left Child: " . $this->heap[2 * $i] . " Right Child: " . $this->heap[2 * $i + 1];
            Logger::debug($string);
        }
    }

    /**
     * returns the number of elements in the heap
     *
     * @return int
     */
    public function length() {
        $array = \array_filter($this->heap, function ($v, $k) {
            return $v !== null;
        }, \ARRAY_FILTER_USE_BOTH);
        return \count($array) - 1;
    }

    /**
     * @param int $element
     */
    public function insert(int $element) {
        $length = $this->length();
        $this->heap[$length + 1] = $element;
        $currentPosition = $this->length();
        $parentPosition = $this->getParentPosition($currentPosition);

        $current = $this->heap[$currentPosition];
        $parent = $this->heap[$parentPosition];

        while (Comparator::lessThen($current, $parent)) {
            $this->swap($currentPosition, $parentPosition);
            $currentPosition = $this->getParentPosition($currentPosition);
            $parentPosition = $this->getParentPosition($currentPosition);
            $current = $this->heap[$currentPosition];
            $parent = $this->heap[$parentPosition];
        }
    }

    /**
     * the parent position is the half of the actual position in an linear list.
     * Let's assume the following list:
     *
     * pos |      1       2        3         4          5
     * -------------------------------------------------------
     * val |     14       27       42        13         17
     *
     * 2 / 2 = 1
     * 3 / 2 = 1.5 = 1
     *
     * Therefore, the parent of 13 would be
     *
     * the linear list would be represented as an tree as following:
     *
     *                  14
     *              /       \
     *             27       42
     *          /     \
     *         13     17
     *
     *
     * @param int $pos
     * @return int
     */
    private function getParentPosition(int $pos): int {
        return $pos === 0 ? 0 : $pos / 2;
    }

    /**
     * swaps the value at the current position with the value at the parent position
     *
     * @param int $current
     * @param int $parent
     */
    private function swap(int $current, int $parent): void {
        $tmp = $this->heap[$current];
        $this->heap[$current] = $this->heap[$parent];
        $this->heap[$parent] = $tmp;
    }

    /**
     * determines if a element is in the heap or not
     *
     * @param int $element
     * @return bool
     */
    public function inHeap(int $element): bool {
        foreach ($this->heap as $key => $value) {
            if (Comparator::equals($element, $value)) {
                return true;
            }
        }
        return false;
    }
}