<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * @author Eugene Kirillov <eug.krlv@gmail.com>
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

namespace doganoo\PHPAlgorithms\Datastructure\Lists\LinkedList;

use doganoo\PHPAlgorithms\Common\Abstracts\AbstractLinkedList;
use doganoo\PHPAlgorithms\Datastructure\Lists\Node;

/**
 * Class SinglyLinkedList
 *
 * @package doganoo\PHPAlgorithms\LinkedList
 */
class SinglyLinkedList extends AbstractLinkedList {

    /**
     * $node is added to the end of the list.
     * The method checks the following:
     *
     *      1.  given node is null. Terminate method and return false
     *      2.  head equals to null. Set head = $node, terminate and return true
     *      3.  iterate over temporary node until you have reached the last
     *          node (iterate until next !== null)
     *
     * once you have reached the end, set $node as next of your
     * temporary node
     *
     * @param Node $node
     * @return bool
     */
    public function append(?Node $node): bool {
        if ($node === null) {
            return false;
        }
        $head = $this->getHead();
        if ($head === null) {
            $this->setHead($node);
            return true;
        }
        while ($head->getNext() !== null) {
            $head = $head->getNext();
        }
        $head->setNext($node);
        return true;
    }

    /**
     * the prepend method simply checks first if the node is still valid.
     * If it does not equal to null, the next pointer of the new node is
     * set to head and the head is set to the new node in order to create
     * the new head.
     *
     * @param \doganoo\PHPAlgorithms\Datastructure\Lists\Node $node
     * @return bool
     */
    public function prepend(?Node $node): bool {
        if ($node === null) {
            return false;
        }
        $node->setNext($this->getHead());
        $this->setHead($node);
        return true;
    }

    /**
     * returns a new instance of SinglyLinkedList
     *
     * @return AbstractLinkedList
     */
    protected function getEmptyInstance(): AbstractLinkedList {
        return new SinglyLinkedList();
    }

}