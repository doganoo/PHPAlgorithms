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

namespace doganoo\PHPAlgorithms\Datastructure\Stackqueue;

use doganoo\PHPAlgorithms\Common\Util\Comparator;


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
class Stack {
    public const ASCENDING = 1;
    public const DESCENDING = 2;
    /**
     * The stack is represented as an array. Note that a stack can also be implemented using a linked list.
     *
     * @var array $stack
     */
    private $stack = [];

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
        return $this->stackSize() === 0;
    }

    /**
     * stores the number of items in the stack to the size member of this class and returns it
     *
     * @return int
     */
    public function stackSize(): int {
        $size = count($this->stack);
        return $size;
    }

    /**
     * pop() removes an item from the top of the stack.
     *
     */
    public function pop() {
        if ($this->stack === null) {
            return false;
        }
        if ($this->isEmpty()) {
            return false;
        }
        /*
         * using array_pop is a better option since
         * it takes the work for removing from the end
         * of the array.
         */
        $return = array_pop($this->stack);
        return $return;
    }

    /**
     * peek() returns the element 'on top' of the stack
     *
     */
    public function peek() {
        if (null === $this->stack) {
            return null;
        }
        if (0 === $this->stackSize()) {
            return null;
        }
        $value = $this->stack[$this->stackSize() - 1];
        return $value;
    }

    /**
     * push() adds an item to the stack.
     *
     * @param $item
     * @return bool
     */
    public function push($item): bool {
        if (!$this->isValid()) {
            return false;
        }
        /*
         * using array_push is the better option since it
         * takes the work of adding to the end.
         */
        array_push($this->stack, $item);
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
}