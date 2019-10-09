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

use doganoo\PHPAlgorithms\Datastructure\Lists\Node;
use doganoo\PHPAlgorithmsTest\Util\LinkedListUtil;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * Class DoublyLinkedListTest PHPUnit test class for doubly linked lists
 */
class DoublyLinkedListTest extends TestCase {

    /**
     * test adding a new node to the DLL
     */
    public function testAdd() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $node = LinkedListUtil::getNode(5, "test");
        $this->assertTrue($list->size() === 3);
        $this->assertTrue($list->isEmpty() === false);
        $list->addNode($node);
        $this->assertTrue($list->size() === 4);
    }

    /**
     * tests retrieving the head of DLL
     */
    public function testGetHead() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $node = $list->getHead();
        $this->assertTrue($node->getKey() === 1);
        $this->assertTrue($node->getValue() === "one");
    }

    /**
     * tests reversing the DLL
     */
    public function testReverse() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $list->reverse();
        $node = $list->getHead();
        $this->assertTrue($node->getKey() === 3);
        $value = $node->getValue();
        $this->assertTrue($value instanceof stdClass);
    }

    /**
     * tests setting the head to a new value
     */
    public function testSetHead() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $node = LinkedListUtil::getNode(5, 6);
        $node->setNext($list->getHead());
        $list->setHead($node);
        $this->assertTrue($list->getHead()->getKey() === 5);
        $this->assertTrue($list->getHead()->getValue() === 6);
        $this->assertTrue($list->size() === 4);
    }

    /**
     * tests deleting a node from a DLL
     */
    public function testDeleteNode() {
        $list    = LinkedListUtil::getDoublyLinkedList();
        $deleted = $list->deleteNode(1);
        $this->assertTrue($deleted);
        $this->assertTrue($list->size() === 2);
        $deleted = $list->deleteNode("testdata");
        $this->assertFalse($deleted);
        $this->assertTrue($list->size() === 2);
    }

    /**
     * tests removing duplicates
     */
    public function testRemoveDuplicates() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $list->add(4, 1);
        $list->removeDuplicates();
        $this->assertTrue($list->size() === 3);
    }

    /**
     * tests retrieving the last X elements
     */
    public function testGetLastElements() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $list->add(4, 4);
        $list->add(5, 5);
        $list->add(6, 5);
        $list->add(7, 7);
        $list->add(8, 8);
        $list->add(9, 9);
        $list->add(10, 10);
        $this->assertTrue($list->size() === 10);
        $newList = $list->getLastElements(4);
        $this->assertTrue($newList->size() === 4);
        $this->assertTrue($newList->getHead()->getKey() === 7);
        $this->assertTrue($newList->getHead()->getValue() === 7);

        $newList = $list->getLastElements(150);
        $this->assertTrue($newList->size() === 10);
    }

    /**
     * tests retrieving the first X elements
     */
    public function testGetFirstElements() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $list->add(4, 4);
        $list->add(5, 5);
        $list->add(6, 5);
        $list->add(7, 7);
        $list->add(8, 8);
        $list->add(9, 9);
        $list->add(10, 10);
        $this->assertTrue($list->size() === 10);
        $newList = $list->getFirstElements(5);
        $this->assertTrue($newList->size() === 5);
        $this->assertTrue($newList->getHead()->getKey() === 1);
        $this->assertTrue($newList->getHead()->getValue() === "one");
        $newList = $list->getLastElements(150);
        $this->assertTrue($newList->size() === 10);
    }

    /**
     * tests appending to a DLL
     */
    public function testAppend() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $node = new Node();
        $node->setKey(4);
        $node->setValue(4);
        $list->append($node);
        $this->assertTrue($list->size() === 4);
        $this->assertTrue($list->getHead()->getKey() === 1);
        $this->assertTrue($list->getHead()->getValue() === "one");
    }

    /**
     * tests prepending to a DLL
     */
    public function testPrepend() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $node = new Node();
        $node->setKey(4);
        $node->setValue(4);
        $list->prepend($node);
        $this->assertTrue($list->size() === 4);
        $this->assertTrue($list->getHead()->getKey() === 4);
        $this->assertTrue($list->getHead()->getValue() === 4);
    }

    /**
     * tests whether the list contains a value
     */
    public function testContainsValue() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $this->assertTrue($list->containsValue("one"));
        $this->assertTrue($list->containsKey(1));
    }

    /**
     * tests retrieving a node by querying its value
     */
    public function testGetNodeByValue() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $node = $list->getNodeByValue("one");
        $this->assertTrue($node instanceof Node);
        $node = $list->getNodeByValue("two");
        $this->assertTrue($node === null);
    }

    /**
     * tests retrieving a node by querying its key
     */
    public function testGetNodeByKey() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $node = $list->getNodeByValue(1);
        $this->assertTrue($node instanceof Node);
        $node = $list->getNodeByValue(-1);
        $this->assertTrue($node === null);
    }

    /**
     * tests removing and replacing a node
     */
    public function testRemoveAndReplace() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $list->remove(2);
        $this->assertTrue($list->size() === 2);
        $this->assertTrue($list->getNodeByKey(2) === null);

        $replaced = $list->replaceValue(3, "stdclass");
        $node     = $list->getNodeByKey(3);
        $this->assertTrue($replaced && $node instanceof Node);
    }

    /**
     * tests whether the singly linked list has a loop or not
     */
    public function testHasLoop() {
        $list = LinkedListUtil::getDoublyLinkedList();
        $this->assertTrue(false === $list->hasLoop());
        $list = LinkedListUtil::getDoublyLinkedListWithLoop();
        $this->assertTrue(true === $list->hasLoop());
    }

    public function testMiddlePart() {
        $ll = LinkedListUtil::getCustomDoublyLinkedList(5);
        /** @var Node $node */
        $node = $ll->getMiddleNode();

        $this->assertTrue(3 === $node->getKey());
        $this->assertTrue(md5((string) 3) === $node->getValue());
    }

}