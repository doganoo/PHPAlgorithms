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

namespace doganoo\PHPAlgorithms\Common\Interfaces;


interface IHeap extends IComparable, \JsonSerializable {

    /**
     * clears the heap
     *
     * @return bool
     */
    public function clear(): bool;

    /**
     * returns the number of elements in the heap
     *
     * @return int
     */
    public function length(): int;

    /**
     * inserts a new element to the heap (currently integers only)
     *
     * @param int $element
     */
    public function insert(int $element): void;

    /**
     * returns the parent position of the current position
     *
     * @param int $position
     * @return int
     */
    public function getParentPosition(int $position): int;

    /**
     * swaps elements current and parent
     *
     * @param int $current
     * @param int $parent
     */
    public function swap(int $current, int $parent): void;

    /**
     * determines whether an element is in the heap or not
     *
     * @param int $element
     * @return bool
     */
    public function inHeap(int $element): bool;

}