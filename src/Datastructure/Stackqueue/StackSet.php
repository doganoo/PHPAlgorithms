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

use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;

/**
 * Class StackSet
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Stackqueue
 */
class StackSet {
    private $maxSize = 0;
    private $counter = 0;
    private $stackList = null;

    public function __construct(int $maxSize = 128) {
        $this->maxSize = $maxSize;
        $this->stackList = new ArrayList();
    }

    public function push($element) {
        $stack = $this->getLastStack();
        $this->addToStack($stack, $element);
    }

    private function getLastStack(): Stack {
        $modulo = $this->counter % $this->maxSize;
        if (0 === $modulo) {
            return new Stack();
        }
        $index = $this->stackList->length();
        $stack = $this->stackList->get($index - 1);
        return $stack;
    }

    private function addToStack(Stack $stack, $element) {
        $stack->push($element);
        $this->counter++;
        if (1 === $stack->stackSize()) {
            $this->stackList->add($stack);
        } else {
            $index = $this->stackList->length();
            $this->stackList->set($index - 1, $stack);
        }
    }

    public function pop() {
        $index = $this->stackList->length();
        /** @var Stack $stack */
        $stack = $this->stackList->get($index - 1);
        $element = $stack->peek();
        $this->counter--;
        if (0 === $stack->stackSize()) {
            $this->stackList->remove($index - 1);
        } else {
            $this->stackList->set($index - 1, $stack);
        }
        return $element;
    }

    public function stackCount(): int {
        return $this->stackList->length();
    }

}