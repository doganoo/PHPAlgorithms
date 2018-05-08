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

namespace doganoo\PHPAlgorithms\Datastructure\Lists\LinkedLists;


use doganoo\PHPAlgorithms\Common\Abstracts\LinkedList;
use doganoo\PHPAlgorithms\Datastructure\lists\Node;

/**
 * Class DoublyLinkedList
 *
 * @package doganoo\PHPAlgorithms\LinkedLists
 */
class DoublyLinkedList extends LinkedList {
    public function append(?Node $node): bool {
        if ($node === null) {
            return false;
        }
        /*
         * need to clone the object otherwise the object
         * references are going crazy.
         *
         * Furthermore, setting previous and next to null
         * as they will be set later.
         */
        $newNode = clone $node;
        $newNode->setPrevious(null);
        $newNode->setNext(null);

        if ($this->getHead() === null) {
            $this->setHead($newNode);
            return true;
        }

        $head = $this->getHead();
        $i = 0;
        while ($head->getNext() !== null) {
            if ($i == 10) break;
            $head = $head->getNext();
            $i++;
        }
        $newNode->setPrevious($head);
        $head->setNext($newNode);
        return true;
    }

    /**
     * prepends a node on top of the list
     *
     * @param \doganoo\PHPAlgorithms\Datastructure\lists\Node|null $node
     * @return bool
     */
    public function prepend(?Node $node): bool {
        if ($node === null) {
            return false;
        }
        /*
         * need to clone the object otherwise the object
         * references are going crazy.
         *
         * Furthermore, setting previous and next to null
         * as they will be set later.
         */
        $newNode = clone $node;
        $newNode->setPrevious(null);
        $newNode->setNext(null);

        if ($this->getHead() === null) {
            $this->setHead($newNode);
            return true;
        }
        $head = $this->getHead();
        $head->setPrevious($newNode);
        $newNode->setNext($head);
        $this->setHead($newNode);
        return true;
    }

    /**
     * returns a new instance of DoublyLinkedList
     *
     * @return LinkedList
     */
    protected function getEmptyInstance(): LinkedList {
        return new DoublyLinkedList();
    }
}