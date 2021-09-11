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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree\Heap;

use doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException;
use doganoo\PHPAlgorithms\Common\Interfaces\IHeap;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use function array_diff;
use function array_fill;
use function array_filter;
use function count;
use function intval;
use const ARRAY_FILTER_USE_BOTH;
use const PHP_INT_MIN;

/**
 * Class MaxHeap
 *
 * see https://www.sanfoundry.com/java-program-implement-min-heap/
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Graph\Tree\Heap
 */
class MaxHeap implements IHeap {
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
        $this->heap = array_fill(0, $this->maxSize, null);
        $this->heap[0] = PHP_INT_MIN;
        return count($this->heap) === 1 && $this->heap[0] == PHP_INT_MIN;
    }

    /**
     * @param int $element
     * @throws IndexOutOfBoundsException
     */
    public function insert(int $element): void {
        $length = $this->length();
        $this->heap[$length + 1] = $element;
        $currentPosition = $this->length();
        $parentPosition = $this->getParentPosition($currentPosition);

        $current = $this->heap[$currentPosition];
        $parent = $this->heap[$parentPosition];

        //this could be implemented in recursive way as well!
        while (Comparator::greaterThan($current, $parent)) {
            $this->swap($currentPosition, $parentPosition);
            //since we have swapped the positions, we need
            //to redefine our current position and parent position
            //and 'bubble up':
            //the current position is the parent position and the
            //parent position is the parent position of the current position
            //(i know, it is confusing :-))
            $currentPosition = $this->getParentPosition($currentPosition);
            $parentPosition = $this->getParentPosition($currentPosition);
            $current = $this->heap[$currentPosition];
            $parent = $this->heap[$parentPosition];
        }
    }

    /**
     * returns the number of elements in the heap
     *
     * @return int
     */
    public function length(): int {
        $array = array_filter($this->heap, function ($v, $k) {
            return $v !== null;
        }, ARRAY_FILTER_USE_BOTH);
        return count($array) - 1;
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
     * @param int $position
     * @return int
     * @throws IndexOutOfBoundsException
     */
    public function getParentPosition(int $position): int {
        if ($position < 0) throw new IndexOutOfBoundsException("$position < 0");
        return $position === 0 ? 0 : intval($position / 2);
    }

    /**
     * swaps the value at the current position with the value at the parent position
     *
     * @param int $current
     * @param int $parent
     */
    public function swap(int $current, int $parent): void {
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

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof MaxHeap) {
            if (count(array_diff($this->heap, $object->heap)) === 0) return 0;
            if (count($this->heap) < count($object->heap)) return -1;
            if (count($this->heap) > count($object->heap)) return 1;
        }
        return -1;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            "heap" => $this->heap
            , "max_size" => $this->maxSize
            , "type" => "MAX_HEAP",
        ];
    }

    /**
     * returns the heap as an array
     *
     * @return array|null
     */
    public function getHeap(): ?array {
        return $this->heap;
    }
}