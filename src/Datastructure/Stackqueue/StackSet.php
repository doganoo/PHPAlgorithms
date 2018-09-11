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

use doganoo\PHPAlgorithms\Common\Interfaces\IComparable;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;

/**
 * Class StackSet
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Stackqueue
 */
class StackSet implements IComparable, \JsonSerializable {
    private $maxSize = 0;
    private $counter = 0;
    private $stackList = null;

    /**
     * StackSet constructor.
     *
     * @param int $maxSize
     */
    public function __construct(int $maxSize = 128) {
        $this->maxSize = $maxSize;
        $this->stackList = new ArrayList();
    }

    /**
     * @param $element
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    public function push($element) {
        $stack = $this->getLastStack();
        $this->addToStack($stack, $element);
    }

    /**
     * @return Stack
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    private function getLastStack(): Stack {
        $modulo = $this->counter % $this->maxSize;
        if (0 === $modulo) {
            return new Stack();
        }
        $index = $this->stackList->length();
        $stack = $this->stackList->get($index - 1);
        return $stack;
    }

    /**
     * @param Stack $stack
     * @param       $element
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    private function addToStack(Stack $stack, $element) {
        $stack->push($element);
        $this->counter++;
        if (1 === $stack->size()) {
            $this->stackList->add($stack);
        } else {
            $index = $this->stackList->length();
            $this->stackList->set($index - 1, $stack);
        }
    }

    /**
     * @return mixed|null
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    public function pop() {
        $index = $this->stackList->length();
        /** @var Stack $stack */
        $stack = $this->stackList->get($index - 1);
        $element = $stack->pop();
        $this->counter--;
        if (0 === $stack->size()) {
            $this->stackList->remove($index - 1);
        } else {
            $this->stackList->set($index - 1, $stack);
        }
        return $element;
    }

    /**
     * @return int
     */
    public function stackCount(): int {
        return $this->stackList->length();
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof StackSet) {
            if (Comparator::equals($this->stackList, $object->stackList)) return 0;
            if (Comparator::lessThan($this->stackList, $object->stackList)) return -1;
            if (Comparator::greaterThan($this->stackList, $object->stackList)) return 1;
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
            "stack_list" => $this->stackList
            , "max_size" => $this->maxSize
            , "counter" => $this->counter,
        ];
    }
}