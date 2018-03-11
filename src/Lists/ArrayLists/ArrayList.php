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

namespace doganoo\PHPAlgorithms\Lists\ArrayLists;


use Traversable;

/**
 * Class ArrayList
 *
 * notice: array lists are not really usable for PHP as the arrays are dynamic sized. Furthermore there are
 * SPL classes like ArrayObject that could be used as a kind of array list.
 *
 * However, for completeness I have decided to implement the class. There are other advantages, such as defined
 * array indices (numeric), trimming the fields and others.
 *
 * @package doganoo\PHPAlgorithms\Lists\ArrayLists
 */
class ArrayList implements \IteratorAggregate {
    /**
     * @var null the array where the values are stored
     */
    private $array = null;

    /**
     * ArrayList constructor initializes the array
     */
    public function __construct() {
        $this->initialize();
    }

    /**
     * sets the array to an empty array
     */
    private function initialize() {
        $this->array = [];
    }

    /**
     * adds $item to the array at the index at $index
     *
     * @param int $index
     * @param     $item
     * @return bool
     */
    public function addToIndex(int $index, $item): bool {
        $oldSize = $this->size();
        if ($oldSize - 1 < $index) {
            $this->add($item);
            return true;
        }
        $array = \array_slice($this->array, $index, $oldSize, true);
        $this->array[$index] = $item;
        $this->array = \array_merge($this->array, $array);
        $this->trimToSize();
        return ($oldSize + 1) === $this->size();
    }

    /**
     * returns the number of elements in the array
     *
     * @return int
     */
    public function size(): int {
        $this->trimToSize();
        return \count($this->array);
    }

    /**
     * removes all elements in the array that are null or equal to empty string
     *
     * @return bool
     */
    public function trimToSize(): bool {
        $array = \array_filter($this->array, function ($value, int $key) {
            return $value !== null || trim($value) !== "";
        }, ARRAY_FILTER_USE_BOTH);
        $array = \array_values($array);
        $changed = $this->array !== $array;
        $this->array = $array;
        return $changed;
    }

    /**
     * adds $item to the end of the array
     *
     * @param $item
     * @return bool
     */
    public function add($item): bool {
        $size = $this->size() === 0 ? 0 : $this->size() + 1;
        if ($size >= 0) {
            $this->array[$size] = $item;
            $this->trimToSize();
            return true;
        }
        return false;
    }

    /**
     * removes all elements of the array
     */
    public function clear() {
        $this->initialize();
    }

    /**
     * returns the element at $index. If there is no element then the method returns null
     *
     * @param int $index
     * @return mixed
     */
    public function get(int $index) {
        return $this->array[$index];
    }

    /**
     * whether the size equals to zero or array is null
     *
     * @return bool
     */
    public function isEmpty(): bool {
        return $this->size() === 0 || $this->array === null;
    }

    /**
     * removes all elements of the array that are part of $arrayList
     *
     * @param ArrayList $arrayList
     * @return bool
     */
    public function removeAll(ArrayList $arrayList): bool {
        $removed = true;
        foreach ($arrayList as $value) {
            $removed &= $this->removeByValue($value);
        }
        $this->trimToSize();
        return $removed;
    }

    /**
     * removes a single value from the list
     *
     * @param $value
     * @return bool
     */
    public function removeByValue($value): bool {
        if (!$this->containsValue($value)) {
            return true;
        }
        $key = $this->indexOf($value);
        $removed = $this->remove($key);
        $this->trimToSize();
        return $removed;
    }

    /**
     * whether the array contains $value or not. The verification is made strictly (type check).
     *
     * @param $value
     * @return bool
     */
    public function containsValue($value): bool {
        return \in_array($value, $this->array, true);
    }

    /**
     * returns the first index of $value in the array or null
     *
     * @param $value
     * @return null
     */
    public function indexOf($value) {
        $array = $this->lastIndexOf($value);
        $return = $array === null ? null : $array[0];
        return $return;
    }

    /**
     * returns all indices of $value in the array or null
     *
     * @param $value
     * @return array|null
     */
    public function lastIndexOf($value) {
        $keys = \array_keys($this->array, $value);
        $return = \count($keys) === 0 ? null : $keys;
        return $return;
    }

    /**
     * removes the field with the $key key from the array
     *
     * @param $key
     * @return bool
     */
    public function remove($key): bool {
        if (isset($this->array[$key])) {
            unset($this->array[$key]);
            return true;
        }
        return false;
    }

    /**
     * removes all fields in the range of $start and $end
     *
     * @param int $start
     * @param int $end
     * @return bool
     */
    public function removeRange(int $start, int $end): bool {
        $removed = true;
        foreach ($this->array as $key => $item) {
            if ($key >= $start && $key <= $end) {
                $removed &= $this->remove($key);
            }
        }
        $this->array = \array_values($this->array);
        $this->trimToSize();
        return $removed;
    }

    /**
     * removes all elements that are not part of $arrayList
     *
     * @param ArrayList $arrayList
     * @return bool
     */
    public function retainAll(ArrayList $arrayList): bool {
        $newArray = [];
        foreach ($arrayList as $value) {
            if (\in_array($value, $this->array)) {
                $newArray[] = $value;
            }
        }
        $result = $this->array !== $newArray;
        $this->array = $newArray;
        $this->trimToSize();
        return $result;
    }

    /**
     * replaces the value at $index with $value
     *
     * @param int $index
     * @param     $value
     * @return bool
     */
    public function set(int $index, $value): bool {
        if (isset($this->array[$index])) {
            $this->array[$index] = $value;
            $this->trimToSize();
            return true;
        }
        return false;
    }

    /**
     * returns a instance of ArrayList with the key/values from $start to $end
     *
     * @param int $start
     * @param int $end
     * @return ArrayList
     */
    public function subList(int $start, int $end): ArrayList {
        //TODO preserve keys?
        $array = \array_slice($this->array, $start, $end, true);
        $arrayList = new ArrayList();
        $arrayList->addAllArray($array);
        $arrayList->trimToSize();
        return $arrayList;
    }

    /**
     * adds all elements of an array to the list
     *
     * @param array $array
     * @return bool
     */
    public function addAllArray(array $array): bool {
        $added = true;
        foreach ($array as $value) {
            $added &= $this->add($value);
        }
        $this->trimToSize();
        return $added;
    }

    /**
     * adds all elements of an array list to the list
     *
     * @param ArrayList $arrayList
     * @return bool
     */
    public function addAll(ArrayList $arrayList): bool {
        $added = true;
        foreach ($arrayList as $value) {
            $added &= $this->add($value);
        }
        $this->trimToSize();
        return $added;
    }

    /**
     * Retrieve an external iterator
     *
     * @link http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator() {
        return new \ArrayIterator($this->array);
    }
}