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

namespace doganoo\PHPAlgorithmsTest\Lists\LinkedList;

use doganoo\PHPAlgorithms\Datastructure\Lists\LinkedList\SinglyLinkedList;
use doganoo\PHPAlgorithmsTest\Util\LinkedListUtil;
use PHPUnit\Framework\TestCase;

/**
 * Class SinglyLinkedListTest PHPUnit test class
 */
class SinglyLinkedListTest extends TestCase {

    /**
     * tests appending a new node to the list
     *
     * note that the underlying LinkedList methods are already tested
     * by DoublyLinkedListTest class and do not need to be tested here.
     */
    public function testAppend(): void {
        $list = LinkedListUtil::getSinglyLinkedList();
        $node = LinkedListUtil::getNode(4, 1);
        $list->append($node);
        $this->assertTrue($list->size() === 4);
        $this->assertTrue($list->getHead()->getKey() === 1);
        $this->assertTrue($list->getHead()->getValue() === "one");
    }

    /**
     * tests prepending a new node to the list
     */
    public function testPrepend(): void {
        $list = LinkedListUtil::getSinglyLinkedList();
        $node = LinkedListUtil::getNode(4, 1);
        $list->prepend($node);
        $this->assertTrue($list->size() === 4);
        $this->assertTrue($list->getHead()->getKey() === 4);
        $this->assertTrue($list->getHead()->getValue() === 1);
    }

    public function testContains(): void {
        $list     = LinkedListUtil::getSinglyLinkedList();
        $contains = $list->containsKey(1);
        $this->assertTrue($contains === true);

        $list->add("test", 2);
        $this->assertTrue($list->size() === 4);
        $this->assertTrue($list->containsKey("testw") === false);
        $this->assertTrue($list->containsKey("test") === true);
    }

    public function testRemove(): void {
        $singlyLinkedList = new SinglyLinkedList();
        $singlyLinkedList->add("calorie_tracker", new class {

        });
        $singlyLinkedList->add("tnc", new class {

        });

        $this->assertTrue(2 === $singlyLinkedList->size());
        $singlyLinkedList->remove("calorie_tracker");
        $this->assertTrue(1 === $singlyLinkedList->size());
    }

}