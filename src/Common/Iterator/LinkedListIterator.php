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

namespace doganoo\PHPAlgorithms\Common\Iterator;

use doganoo\PHPAlgorithms\Common\Abstracts\AbstractLinkedList;
use doganoo\PHPAlgorithms\Datastructure\Lists\Node;
use Iterator;

/**
 * Class LinkedListIterator
 * @package doganoo\PHPAlgorithms\Common\Iterator
 */
class LinkedListIterator implements Iterator {

    private AbstractLinkedList $linkedList;
    private ?Node              $root;
    private int                $i;

    /**
     * LinkedListIterator constructor.
     * @param AbstractLinkedList $linkedList
     */
    public function __construct(AbstractLinkedList $linkedList) {
        $this->linkedList = $linkedList;
        $this->root       = $this->linkedList->getHead();
        $this->i          = $this->root->size() + 1;
    }

    /**
     * @inheritDoc
     */
    public function current(): mixed {
        return $this->root;
    }

    /**
     * @inheritDoc
     */
    public function next(): void {
        $this->root = $this->root->getNext();
        $this->i++;
    }

    /**
     * @inheritDoc
     */
    public function key(): mixed {
        $key = $this->root->getKey();

        if (true === is_int($key) || true === is_string($key)) {
            return $key;
        }

        return $this->i;
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool {
        return null !== $this->root;
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void {
        $this->i    = $this->root->size() + 1;
        $this->root = $this->linkedList->getHead();
    }

}