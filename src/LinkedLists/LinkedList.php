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

namespace doganoo\PHPAlgorithms\LinkedLists;


class LinkedList
{
    /** @var Node */
    private $head = null;

    /**
     * $node should be added to the end of the list.
     * Therefore, 3 steps are needed:
     *
     *      1.  check if the head equals to null. If so, set head = $node
     *          and end the function
     *      2.  create a temporary instance of Node and set it to head
     *      3.  iterate over temporary node until you have reached the last
     *          node (iterate until next == null)
     *
     * once you have reached the end, set $node as next of your
     * temporary node
     *
     * @param Node $node
     */
    public function appendToTail(Node $node)
    {
        if ($this->head == null) {
            $this->head = $node;
            return;
        }
        $n = $this->head;
        while ($n->getNext() !== null) {
            $n = $n->getNext();
        }
        $n->setNext($node);
    }

    /**
     * the prepend method simply checks first if the node is still valid.
     * If it does not equal to null, the next pointer of the new node is
     * set to head and the head is set to the new node in order to create
     * the new head.
     *
     * @param Node $node
     */
    public function prepend(Node $node)
    {
        if ($node == null) {
            return;
        }

        $node->setNext($this->head);
        $this->setHead($node);
    }

    /**
     * there are three pointers needed in order to reverse a
     * list:
     *
     * 1. the previous one, which is initialized to null
     * 2. the next one, which is initialized to null
     * 3. the current which is the head
     *
     * at the end of this operation, $previous will contain the reversed
     * list as we append all $prev instances to $current and then
     * set $current equal to $prev.
     * $next servers as a temporary instance in order to ensure the
     * head is not lost.
     *
     * suppose we have the following list: 1 -> 2 -> 3 -> 4 -> 5 -> NULL
     *
     *          1. NULL <- 1 -> 2 -> 3 -> 4 -> 5
     *          2. NULL <- 1 <- 2 -> 3 -> 4 -> 5
     *          3. NULL <- 1 <- 2 <- 3 -> 4 -> 5
     *          4. NULL <- 1 <- 2 <- 3 <- 4 -> 5
     *          5. NULL <- 1 <- 2 <- 3 <- 4 <- 5
     *          ================================
     *             5 -> 4 -> 3 -> 2 -> 1 -> NULL
     */
    public function reverse()
    {
        $prev = null;
        $next = null;
        $current = $this->head;

        while ($current != null) {
            $next = $current->getNext();
            $current->setNext($prev);
            $prev = $current;
            $current = $next;
        }
        $this->head = $prev;
    }

    /**
     * There are 3 basic steps to delete a node from a list:
     *
     *          1.  check if head is null and return if this is the case
     *          2.  check if the value of head equals to the node that should
     *              be deleted. If so, set head to head->next and return.
     *          3.  iterate over head, check if the value of next equals to
     *              the node that should be deleted and set head->next to
     *              head->next->next if this is the case.
     *
     * @param int $data
     * @return bool
     */
    public function deleteNode(int $data)
    {
        if ($this->getHead() === null) {
            return false;
        }
        $head = $this->getHead();

        if ($head->getValue() == $data) {
            if ($head->getNext() !== null) {
                $this->head = $head->getNext();
                return true;
            }
        }

        while ($head->getNext() !== null) {
            if ($head->getNext()->getValue() == $data) {
                $head->setNext($head->getNext()->getNext());
                return true;
            }
            $head = $head->getNext();
        }
        return false;
    }

    public function removeDuplicates()
    {
        $node = $this->head;
        $previous = $this->head;
        $visited = [];

        while ($node !== null) {
            if (in_array($node->getValue(), $visited)) {
                $previous->setNext($node->getNext());
            } else {
                $visited[] = $node->getValue();
                $previous = $node;
            }
            $node = $node->getNext();
        }
    }

    public function removeDuplicatesWithoutBuffer()
    {
        $tortoise = $this->head;

        while ($tortoise !== null) {
            $hare = $tortoise;
            while ($hare->getNext() !== null) {
                if ($hare->getNext()->getValue() == $tortoise->getValue()) {
                    $hare->setNext($hare->getNext()->getNext());
                } else {
                    $hare = $hare->getNext();
                }
            }
            $tortoise = $tortoise->getNext();
        }
    }

    /**
     * all nodes from k to the end of the list is requested by this method.
     * In order to ensure this, we need to do the following steps:
     *
     *          1.  create two pointers $p1 and $p2
     *          2.  loop from 0 to k and set $p1 = $p1->next
     *          3.  if $p1 reaches null when the loop is looping,
     *              return null. This means, that k > list->size and
     *              there are no nodes to return.
     *          4.  iterate over $p1 until it is null. Within the loop,
     *              set $p1 = $p1->next and $p2 = $p2->next. When the loop
     *              ends, $p2 points to the kth element of the list.
     *          5.  return $p2.
     *
     * @param int $k
     * @return Node|null
     */
    public function kToLast(int $k)
    {
        $p1 = $this->head;
        $p2 = $this->head;

        for ($i = 0; $i < $k; $i++) {
            if ($p1 == null) {
                return null;
            }
            $p1 = $p1->getNext();
        }

        while ($p1 != null) {
            $p1 = $p1->getNext();
            $p2 = $p2->getNext();
        }

        return $p2;
    }

    public function kToFirst(int $k)
    {
        $p1 = $this->head;
        $linkedList = new LinkedList();

        /**
         * notice that the for loop starts at 1, not 0!
         */
        for ($i = 0; $i < $k; $i++) {
            $n = new Node();
            $n->setValue($p1->getValue());
            $linkedList->appendToTail($n);
            $p1 = $p1->getNext();
        }
        $linkedList->printList();
        return $linkedList;
    }

    public function getNode(int $value)
    {
        $head = $this->head;

        while ($head !== null) {
            if ($head->getValue() == $value) {
                return $head;
            }
            $head = $head->getNext();
        }

        return null;
    }

    //This problem cannot be solved if the node to be deleted is
    //the last node in the linked list
    //node could be marked as dummy
    public function deleteGivenNode(Node $node)
    {
        if ($node == null || $node->getNext() == null) {
            return null;
        }
        /**
         * a given node should be deleted from itself.
         * To do this, we simply take the next instance and
         * append it to the actual one
         */
        $tmp = $node->getNext();
        $node->setValue($tmp->getValue());
        $node->setNext($tmp->getNext());
        return $node;
    }

    public function partitionAtValue(int $value)
    {
        $linkedList = new LinkedList();
        $head = $this->head;

        while ($head !== null) {
            $node = new Node();
            $node->setValue($head->getValue());
            if ($head->getValue() < $value) {
                $linkedList->prepend($node);
            } else {
                $linkedList->appendToTail($node);
            }
            $head = $head->getNext();
        }
        return $linkedList;
    }

    public function size()
    {
        if ($this->isEmpty()) {
            return 0;
        }
        return $this->head->size();
    }

    public function isEmpty()
    {
        return $this->head == null;
    }

    public function setHead(Node $node)
    {
        $this->head = $node;
    }

    public function getHead(): ?Node
    {
        return $this->head;
    }

    public function printList()
    {
        $head = $this->getHead();

        $i = 0;
        while ($head !== null) {
            $i++;
            echo $head->getValue();
            echo "\n";
            $head = $head->getNext();
        }

    }

}