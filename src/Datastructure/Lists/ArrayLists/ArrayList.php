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

namespace doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists;

use ArrayIterator;
use doganoo\PHPAlgorithms\Algorithm\Sorting\TimSort;
use doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException;
use doganoo\PHPAlgorithms\Common\Interfaces\IComparable;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use IteratorAggregate;
use JsonSerializable;
use Traversable;
use function array_diff;
use function array_fill;
use function array_filter;
use function array_slice;
use function array_values;
use function count;
use function in_array;
use const ARRAY_FILTER_USE_BOTH;

/**
 * Class ArrayList
 *
 * notice: array lists are not really usable for PHP as the arrays are dynamic sized. Furthermore there are
 * SPL classes like ArrayObject that could be used as a kind of array list.
 *
 * However, for completeness I have decided to implement the class. There are other advantages, such as defined
 * array indices (numeric), trimming the fields and others.
 *
 * TODO actually this class can not handle negative indices (keys). Need to fix that.
 *
 * see here: https://gist.github.com/wwsun/71ebbaded68930884746
 *
 * @package doganoo\PHPAlgorithms\Lists\ArrayLists
 */
class ArrayList implements IteratorAggregate, JsonSerializable, IComparable {

    /**
     * @const DEFAULT_ARRAY_SIZE
     */
    public const DEFAULT_CAPACITY = 128;
    /**
     * @var null the array where the values are stored
     */
    private $array = null;

    /**
     * @var int the actual size
     */
    private $size = 0;

    /**
     * ArrayList constructor initializes the array
     */
    public function __construct() {
        $this->clear();
    }

    /**
     * removes all elements of the array
     */
    public function clear() {
        $this->size = 0;
        $this->ensureCapacity(self::DEFAULT_CAPACITY);
    }

    private function ensureCapacity(int $newCapacity): bool {
        if ($newCapacity < $this->size()) {
            return false;
        }

        $array       = $this->array;
        $this->array = array_fill(0, $newCapacity, null);
        for ($i = 0; $i < $this->size(); $i++) {
            $this->array[$i] = $array[$i];
        }
        return true;
    }

    /**
     * returns the number of elements in the array
     *
     * @return int
     */
    public function size(): int {
        return $this->size;
    }

    /**
     * returns the element at $index. If there is no element then the method returns null
     *
     * @param int $index
     * @return mixed
     * @throws IndexOutOfBoundsException
     */
    public function get(int $index) {
        if ($index < 0 || $index >= $this->size()) {
            throw new IndexOutOfBoundsException();
        }
        return $this->array[$index];

    }

    /**
     * whether the size equals to zero or array is null
     *
     * @return bool
     */
    public function isEmpty(): bool {
        return $this->length() === 0 || $this->array === null;
    }

    public function length(): int {
        $array = $this->array;
        $array = array_filter($array, function ($value, $key) {
            return $value !== null;
        }, ARRAY_FILTER_USE_BOTH);
        return count($array);
    }

    /**
     * removes all elements of the array that are part of $arrayList
     *
     * @param ArrayList $arrayList
     * @return bool
     */
    public function removeAll(ArrayList $arrayList): bool {
        $removed = false;
        foreach ($arrayList as $value) {
            $valueRemoved = $this->removeByValue($value);
            $removed      = $removed || $valueRemoved;
        }
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
        $key     = $this->indexOf($value);
        $removed = $this->remove($key);
        return $removed;
    }

    /**
     * whether the array contains $value or not. The verification is made strictly (type check).
     *
     * @param      $value
     * @return bool
     */
    public function containsValue($value): bool {
        foreach ($this->array as $key => $val) {
            if (null === $val) {
                continue;
            }
            if (Comparator::equals($val, $value)) {
                return true;
            }
        }
        return false;
    }

    /**
     * returns the first index of $value in the array or null
     *
     * @param $value
     * @return int|null
     */
    public function indexOf($value): ?int {
        $array  = $this->lastIndexOf($value);
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
        $array = [];
        foreach ($this->array as $key => $val) {
            if (null === $val) {
                continue;
            }
            if (Comparator::equals($val, $value)) {
                $array[] = $key;
            }
        }
        return count($array) === 0 ? null : $array;
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
     * whether the array contains $key or not.
     *
     * @param int $key
     * @return bool
     */
    public function containsKey(int $key): bool {
        $array = $this->array;
        $array = array_filter($array, function ($value, $key) {
            return $value !== null;
        }, ARRAY_FILTER_USE_BOTH);
        return array_key_exists($key, $array);
    }

    /**
     * removes all elements in the array that are null or equal to empty string
     *
     * @return bool
     */
    public function trimToSize(): bool {
        return $this->ensureCapacity($this->size());
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
                $keyRemoved = $this->remove($key);
                $removed    = $removed && $keyRemoved;
            }
        }
        $this->array = array_values($this->array);
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
            if (in_array($value, $this->array)) {
                $newArray[] = $value;
            }
        }
        $result      = $this->array !== $newArray;
        $this->array = $newArray;
        return $result;
    }

    /**
     * replaces the value at $index with $value
     *
     * @param int $index
     * @param     $value
     * @return bool
     * @throws IndexOutOfBoundsException
     */
    public function set(int $index, $value): bool {
        if ($index < 0 || $index > $this->size()) {
            throw new IndexOutOfBoundsException();
        }
        $this->array[$index] = $value;
        return true;
    }

    /**
     * returns a instance of ArrayList with the key/values from $start to $end
     *
     * @param int $start
     * @param int $end
     * @return ArrayList
     */
    public function subList(int $start, int $end): ArrayList {
        $arrayList = new ArrayList();
        if (($start === $end) || ($start > $end)) {
            return $arrayList;
        }
        //TODO preserve keys?
        $array = array_slice($this->array, $start, $end - $start, true);
        $arrayList->addAllArray($array);
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
            $valueAdded = $this->add($value);
            $added      = $added && $valueAdded;
        }
        return $added;
    }

    /**
     * adds $item to the end of the array
     *
     * @param $item
     * @return bool
     */
    public function add($item): bool {
        return $this->addToIndex($this->length(), $item);
    }

    /**
     * adds $item to the array at the index at $index
     *
     * TODO insert or override?
     *
     * @param int $index
     * @param     $item
     * @return bool
     */
    public function addToIndex(int $index, $item): bool {
        if (count($this->array) === $this->size()) {
            $this->ensureCapacity($this->size() * 2 + 1);
        }
        $this->array[$index] = $item;
        $this->size++;
        return true;
    }

    /**
     * adds all elements of an array list to the list
     *
     * @param ArrayList $arrayList
     * @return bool
     */
    public function addAll(ArrayList $arrayList): bool {
        $added = false;
        foreach ($arrayList as $value) {
            $valueAdded = $this->add($value);
            $added      = $added || $valueAdded;
        }
        return $added;
    }

    /**
     * Retrieve an external iterator
     *
     * It is not ensured that all fields of the array list is filled with
     * valid values. Therefore, it has to be ensured that the iterator gets only
     * those values which are added by the user to the list.
     *
     * @link  http://php.net/manual/en/iteratoraggregate.getiterator.php
     * @return Traversable An instance of an object implementing <b>Iterator</b> or
     * <b>Traversable</b>
     * @since 5.0.0
     */
    public function getIterator() {
        $array = array_slice($this->array, 0, $this->length(), true);
        return new ArrayIterator($array);
    }

    /**
     * @param ArrayList $arrayList
     * @return bool
     */
    public function equals(ArrayList $arrayList): bool {
        foreach ($arrayList as $value) {
            if (!$this->containsValue($value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * wrapper method for "containsValue()"
     *
     * @param $value
     * @return bool
     */
    public function inList($value): bool {
        return $this->containsValue($value);
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof ArrayList) {
            if (count(array_diff($this->array, $object->array)) === 0) return 0;
            if (count($this->array) < count($object->array)) return -1;
            if (count($this->array) > count($object->array)) return 1;
        }
        return -1;
    }

    /**
     * @return bool
     */
    public function sort(): bool {
        $array = array_filter($this->array, function ($value, $key) {
            return $value !== null;
        }, ARRAY_FILTER_USE_BOTH);


        $timSort     = new TimSort();
        $array       = $timSort->sort($array);
        $this->array = array_fill(0, self::DEFAULT_CAPACITY, null);
        $this->addAllArray($array);
        return true;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            "default_capacity" => ArrayList::DEFAULT_CAPACITY
            , "size"           => count($this->array)
            , "length"         => $this->length()
            , "content"        => $this->array,
        ];
    }

}
