<?php
declare(strict_types=1);
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

namespace doganoo\PHPAlgorithms\Datastructure\Stackqueue;

use doganoo\PHPAlgorithms\Common\Interfaces\IComparable;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use JsonSerializable;
use function array_diff;
use function count;

/**
 * PHP implementation of a stack.
 * See here for more information: https://www.geeksforgeeks.org/stack-data-structure-introduction-program/
 *
 * The following methods have a time complexity of O(1) since there is no loop when calling them:
 *
 * <ul>push()</ul>
 * <ul>pop()</ul>
 * <ul>peek()</ul>
 * <ul>isEmpty()</ul>
 * <ul>stackSize()</ul>
 * <ul>isValid()</ul>
 *
 * Pros of using stacks:
 * <ul>easy to implement</ul>
 *
 * Cons of using stacks:
 * <ul>not dynamic as arrays does not grow and shrink at runtime (not exactly valid for PHP). Thins con
 * may be by passed using linked lists but then, it requires more memory since it uses Node instances</ul>
 *
 * Class Stack
 *
 * @package StackQueue
 */
class Stack implements IComparable, JsonSerializable {

    public const ASCENDING  = 1;
    public const DESCENDING = 2;
    /**
     * The stack is represented as an array. Note that a stack can also be implemented using a linked list.
     *
     * @var array $stack
     */
    private $stack = [];

    /** @var int $size */
    private $size = 0;

    /**
     * sorts the stack in descending order
     *
     * TODO add ascending order
     */
    public function sort(): void {
        $r = new Stack();
        while (!$r->isEmpty()) {
            $tmp = $this->pop();

            while ((!$r->isEmpty()) && (Comparator::lessThan($r->peek(), $tmp))) {
                $this->push($r->pop());
            }

            $r->push($tmp);
        }

        while (!$r->isEmpty()) {
            $this->push($r->pop());
        }
    }

    /**
     * returns a boolean that determines if the stack is empty or not
     *
     * @return bool
     */
    public function isEmpty(): bool {
        return $this->size() === 0;
    }

    /**
     * stores the number of items in the stack to the size member of this class and returns it
     *
     * @return int
     * @deprecated
     */
    public function stackSize(): int {
        return $this->size;
    }

    /**
     * pop() removes an item from the top of the stack.
     *
     */
    public function pop() {
        if (null === $this->stack) return null;
        if ($this->isEmpty()) return null;

        $this->size--;
        $value = $this->stack[$this->size];
        return $value;
    }

    /**
     * peek() returns the element 'on top' of the stack
     *
     */
    public function peek() {
        if (null === $this->stack) return null;
        if ($this->isEmpty()) return null;

        $value = $this->stack[$this->size];
        return $value;
    }

    /**
     * push() adds an item to the stack.
     *
     * @param $item
     * @return bool
     */
    public function push($item): bool {
        if (!$this->isValid()) return false;

        $this->stack[$this->size] = $item;
        $this->size++;
        return true;
    }

    /**
     * checks if the stack element (the array) is zero
     *
     * @return bool
     */
    protected function isValid(): bool {
        return $this->stack !== null;
    }

    /**
     * wrapper method for stackSize()
     *
     * @return int
     */
    public function size(): int {
        return $this->size;
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof Stack) {
            if (count(array_diff($this->stack, $object->stack)) === 0) return 0;
            if (count($this->stack) < count($object->stack)) return -1;
            if (count($this->stack) > count($object->stack)) return 1;
        }
        return -1;
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
            "stack" => $this->stack,
            "size"  => $this->size,
        ];
    }

}