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

namespace doganoo\PHPAlgorithms\Datastructure\Sets;


use doganoo\PHPAlgorithms\Common\Abstracts\AbstractSet;
use doganoo\PHPAlgorithms\Common\Interfaces\Set;
use doganoo\PHPAlgorithms\Datastructure\Maps\HashMap;

/**
 * Class HashSet
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Sets
 */
class HashSet extends AbstractSet implements Set {
    private $hashMap = null;

    public function __construct() {
        $this->hashMap = new HashMap();
    }

    /**
     * Adds all of the elements in the specified collection to this set if they're not already present (optional
     * operation).
     *
     * @param $elements
     * @return bool
     * @throws \ReflectionException
     * @throws \doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException
     */
    public function addAll($elements): bool {
        $added = false;
        if (\is_iterable($elements)) {
            foreach ($elements as $element) {
                $added |= $this->add($element);
            }
        }
        return $added;
    }

    /**
     * Adds the specified element to this set if it is not already present (optional operation).
     *
     * @param $element
     * @return bool
     * @throws \doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException
     */
    public function add($element): bool {
        $contains = $this->contains($element);
        if ($contains) {
            return false;
        }
        return $this->hashMap->add($element, true);
    }

    /**
     * Returns true if this set contains the specified element.
     *
     * @param $object
     * @return bool
     */
    public function contains($object): bool {
        return $this->hashMap->containsKey($object);
    }

    /**
     * Removes all of the elements from this set (optional operation).
     */
    public function clear(): void {
        $this->hashMap->clear();
    }

    /**
     * Returns true if this set contains all of the elements of the specified collection.
     *
     * @param $elements
     * @return bool
     */
    public function containsAll($elements): bool {
        $contains = false;
        if (\is_iterable($elements)) {
            foreach ($elements as $element) {
                $contains &= $this->contains($element);
            }
        }
        return $contains;
    }

    /**
     * Returns true if this set contains no elements.
     *
     * @return bool
     */
    public function isEmpty(): bool {
        return $this->hashMap->size() === 0;
    }

    /**
     * Removes the specified element from this set if it is present (optional operation).
     *
     * @param $object
     * @return bool
     * @throws \doganoo\PHPAlgorithms\Common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\Common\Exception\UnsupportedKeyTypeException
     */
    public function remove($object): bool {
        return $this->hashMap->remove($object);
    }

    /**
     * Retains only the elements in this set that are contained in the specified collection (optional operation).
     *
     * @param $elements
     * @return bool
     */
    public function retainAll($elements): bool {
        // TODO: Implement retainAll() method.
        return false;
    }

    /**
     * Returns the number of elements in this set (its cardinality).
     *
     * @return int
     */
    public function size(): int {
        return $this->hashMap->size();
    }

    /**
     * Returns an array containing all of the elements in this set.
     *
     * @return array
     */
    public function toArray(): array {
        return $this->hashMap->keySet();
    }
}