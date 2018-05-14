<?php
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

namespace doganoo\PHPAlgorithms\datastructure\stackqueue;

use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\Heap\MinHeap;

/**
 * Class PriorityQueue
 *
 * @package doganoo\PHPAlgorithms\datastructure\stackqueue
 */
class PriorityQueue {
    /** @var MinHeap|null $minHeap */
    private $minHeap = null;

    /**
     * PriorityQueue constructor.
     */
    public function __construct() {
        $this->minHeap = new MinHeap();
    }

    /**
     * Removes all of the elements from this priority queue.
     */
    public function clear(): void {
        //TODO implement clear
    }

    /**
     * Returns true if this queue contains the specified element.
     *
     * @param int $element
     * @return bool
     */
    public function contains(int $element): bool {
        //TODO implement contains
    }

    /**
     * Inserts the specified element into this priority queue.
     *
     * @param int $element
     * @return bool
     */
    public function offer(int $element): bool {
        return $this->add($element);
    }

    /**
     * Inserts the specified element into this priority queue.
     *
     * @param int $element
     * @return bool
     */
    public function add(int $element): bool {
        $this->minHeap->insert($element);
    }

    /**
     * Retrieves, but does not remove, the head of this queue, or returns null if this queue is empty.
     *
     * @return int|null
     */
    public function peek(): ?int {
//TODO implement
    }

    /**
     * Retrieves and removes the head of this queue, or returns null if this queue is empty.
     *
     * @return int|null
     */
    public function poll(): ?int {
//TODO implement
    }

    /**
     * Removes a single instance of the specified element from this queue, if it is present.
     *
     * @param int $element
     * @return bool
     */
    public function remove(int $element): bool {
        //TODO implement
    }

    /**
     * Returns the number of elements in this collection.
     *
     * @return int
     */
    public function size(): int {
        $this->minHeap->length();
    }

    /**
     * Returns an array containing all of the elements in this queue.
     *
     * @return array
     */
    public function toArray(): array {
//TODO implemnt
    }

//<T> T[]    toArray(T[] a)
//Returns an array containing all of the elements in this queue;
//the runtime type of the returned array is that of the specified array.

//Comparator<? super E>	comparator()
//Returns the comparator used to order the elements in this queue, or null if this queue is sorted according to the natural ordering of its elements.

//Iterator<E>    iterator()
//Returns an iterator over the elements in this queue.
}