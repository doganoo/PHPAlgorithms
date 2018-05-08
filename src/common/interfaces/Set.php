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

namespace doganoo\PHPAlgorithms\Common\Interfaces;

/**
 * Interface Set
 *
 * @package doganoo\PHPAlgorithms\common\interfaces
 */
interface Set {
    /**
     * Adds the specified element to this set if it is not already present (optional operation).
     *
     * @param $element
     * @return bool
     */
    public function add($element): bool;

    /**
     * Adds all of the elements in the specified collection to this set if they're not already present (optional
     * operation).
     *
     * @param $elements
     * @return bool
     */
    public function addAll($elements): bool;

    /**
     * Removes all of the elements from this set (optional operation).
     */
    public function clear(): void;

    /**
     * Returns true if this set contains the specified element.
     *
     * @param $object
     * @return bool
     */
    public function contains($object): bool;

    /**
     * Returns true if this set contains all of the elements of the specified collection.
     *
     * @param $elements
     * @return bool
     */
    public function containsAll($elements): bool;

    /**
     * Compares the specified object with this set for equality.
     *
     * @param $object
     * @return mixed
     */
    public function equals($object): bool;

    /**
     * Returns the hash code value for this set.
     *
     * @return int
     */
    public function hashCode(): int;

    /**
     * Returns true if this set contains no elements.
     *
     * @return bool
     */
    public function isEmpty(): bool;

    /**
     * Removes the specified element from this set if it is present (optional operation).
     *
     * @param $object
     * @return bool
     */
    public function remove($object): bool;

    /**
     * Removes from this set all of its elements that are contained in the specified collection (optional operation).
     *
     * @param $elements
     * @return bool
     */
    public function removeAll($elements): bool;

    /**
     * Retains only the elements in this set that are contained in the specified collection (optional operation).
     *
     * @param $elements
     * @return bool
     */
    public function retainAll($elements): bool;

    /**
     * Returns the number of elements in this set (its cardinality).
     *
     * @return int
     */
    public function size(): int;

    /**
     * Returns an array containing all of the elements in this set.
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * TODO implement the following methods
     * Iterator<E>    iterator()
     * Returns an iterator over the elements in this set.
     */

}