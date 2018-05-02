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

use doganoo\PHPAlgorithms\Datastructure\lists\Node;


/**
 * Class LinkedList
 *
 * TODO sentinels?
 *
 * @package doganoo\PHPAlgorithms\LinkedLists
 */
abstract class LinkedList {
    /** @var \doganoo\PHPAlgorithms\Datastructure\lists\Node */
    private $head = null;

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
    public function reverse() {
        $prev = null;
        $next = null;
        $current = $this->getHead();

        while ($current !== null) {
            $next = $current->getNext();
            $current->setNext($prev);
            $prev = $current;
            $current = $next;
        }
        $this->setHead($prev);
    }

    /**
     * returns the head node or null, if no head is set
     *
     * @return \doganoo\PHPAlgorithms\Datastructure\lists\Node|null
     */
    public function getHead(): ?Node {
        return $this->head;
    }

    /**
     * sets the head
     *
     * @param \doganoo\PHPAlgorithms\Datastructure\lists\Node|null $node
     */
    public function setHead(?Node $node) {
        $this->head = $node;
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
     * @param  $data
     * @return bool
     */
    public function deleteNode($data): bool {
        if ($this->getHead() === null) {
            return false;
        }
        $head = $this->getHead();

        if ($head->getValue() === $data) {
            if ($head->getNext() !== null) {
                $this->setHead($head->getNext());
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

    /**
     * The method uses the runner technique in order to iterate over
     * head twice. If the list contains duplicates, the next-next is set
     * as the next node of the current node.
     */
    public function removeDuplicates() {
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
     *          5.  iterate over p2 and add all nodes to the list.
     *          6.  return the list.
     *
     * @param int $number
     * @return LinkedList|null
     *
     */
    public function getLastElements(int $number): LinkedList {
        $p1 = $this->getHead();
        $p2 = $this->getHead();
        $number = $number > $this->head->size() ? $this->head->size() : $number;
        $list = $this->getEmptyInstance();

        for ($i = 0; $i < $number; $i++) {
            if ($p1 == null) {
                return null;
            }
            $p1 = $p1->getNext();
        }

        while ($p1 !== null) {
            $p1 = $p1->getNext();
            $p2 = $p2->getNext();
        }
        while ($p2 !== null) {
            $list->append($p2);
            $p2 = $p2->getNext();
        }

        return $list;
    }

    /**
     * abstract method that requires inheritors to return their type
     *
     * @return LinkedList
     */
    protected abstract function getEmptyInstance(): LinkedList;

    /**
     * abstract method that requires inheritors to implement the way how
     * values are prepended to the list
     *
     * @param \doganoo\PHPAlgorithms\Datastructure\lists\Node|null $node
     * @return bool
     */
    public abstract function append(?Node $node): bool;

    ////This problem cannot be solved if the node to be deleted is
    ////the last node in the linked list
    ////node could be marked as dummy
    // TODO transfer to Node class
    //public function deleteGivenNode(Node $node) {
    //    if ($node == null || $node->getNext() == null) {
    //        return null;
    //    }
    //    /**
    //     * a given node should be deleted from itself.
    //     * To do this, we simply take the next instance and
    //     * append it to the actual one
    //     */
    //    $tmp = $node->getNext();
    //    $node->setValue($tmp->getValue());
    //    $node->setNext($tmp->getNext());
    //    return $node;
    //}

    /**
     * iterates $number times over the head and returns a list that
     * contains $number elements
     *
     * @param int $number
     * @return LinkedList
     */
    public function getFirstElements(int $number): LinkedList {
        $head = $this->getHead();
        //if there are more elements requested than the list provides
        $number = $number > $head->size() ? $head->size() : $number;
        $list = $this->getEmptyInstance();
        $i = 0;
        while ($i < $number) {
            //TODO append or prepend?
            $list->append($head);
            $head = $head->getNext();
            $i++;
        }
        return $list;
    }

    /**
     * abstract method that requires inheritors to implement the way how
     * values are prepended to the list
     *
     * @param \doganoo\PHPAlgorithms\Datastructure\lists\Node|null $node
     * @return bool
     */
    public abstract function prepend(?Node $node): bool;

    //TODO FIXME partition works actually only for singly linked lists
    //public function partition(int $value) {
    //    $head = $this->getHead();
    //    $list = $this->getEmptyInstance();
    //    $i = 0;
    //    while ($head !== null) {
    //        $node = new Node();
    //        $node->setKey($head->getKey());
    //        $node->setValue($head->getValue());
    //        if ($head->getValue() < $value) {
    //            $list->prepend($node);
    //        } else {
    //            $list->append($node);
    //        }
    //        $head = $head->getNext();
    //        $i++;
    //    }
    //    return $list;
    //}

    /**
     * returns the number of elements in a list
     *
     * @return int
     */
    public function size() {
        if ($this->isEmpty()) {
            return 0;
        }
        return $this->head->size();
    }

    /**
     * if the list is empty or not
     *
     * @return bool
     */
    public function isEmpty() {
        return $this->head == null;
    }

    /**
     * adds a Node instance to the list
     *
     * TODO decide whether using add or append/prepend
     *
     * @param \doganoo\PHPAlgorithms\Datastructure\lists\Node $node
     */
    public function addNode(Node $node) {
        $this->add($node->getKey(), $node->getValue());
    }

    /**
     * adds a key/value pair to the hashmap.
     *
     * TODO decide whether this method or append/prepend should be used
     *
     * @param $key
     * @param $value
     * @throws \ReflectionException
     */
    public function add($key, $value) {
        //TODO handle serialize and unserialize
        /**
         * allow objects to be serialized. Restrict callable which are
         * an instance of 'Callable' being serialized since it is
         * not permitted.
         * Also, restrict anonymous classes from being serialized.
         */
        if (\is_object($value) && !\is_callable($value)) {
            $reflectionClass = new \ReflectionClass($value);
            if (!$reflectionClass->isAnonymous()) {
                $value = \serialize($value);
            }
        }

        $node = new Node();
        $node->setKey($key);
        $node->setValue($value);
        $this->append($node);
    }

    /**
     * searches the list for a node by a given key
     *
     * @param $value
     * @return \doganoo\PHPAlgorithms\Datastructure\lists\Node|null
     */
    public function getNodeByValue($value): ?Node {
        if (!$this->containsValue($value)) {
            return null;
        }
        $tmp = $this->getHead();
        while ($tmp !== null) {
            $val = $tmp->getValue();
            //TODO FIXME implement and test!
            //if (\is_string($val)) {
            //    $serialized = MapUtil::isSerialized($val);
            //    if ($serialized) {
            //        \ob_flush();
            //        $val = \unserialize($val);
            //    }
            //}
            if ($val === $value) {
                //if the value is found then return it
                return $tmp;
            }
            $tmp = $tmp->getNext();
        }
        return null;
    }

    /**
     * searches the list for a given value
     *
     * @param $value
     * @return bool
     */
    public function containsValue($value): bool {
        $node = $this->getHead();
        while ($node !== null) {
            //TODO unserialize
            if ($node->getValue() === $value) {
                return true;
            }
            $node = $node->getNext();
        }
        return false;
    }

    /**
     * returns a node by a given key
     *
     * @param $key
     * @return \doganoo\PHPAlgorithms\Datastructure\lists\Node|null
     */
    public function getNodeByKey($key): ?Node {
        if (!$this->containsKey($key)) {
            return null;
        }
        $head = $this->getHead();
        while ($head !== null) {
            //if the value is found then return it
            if ($head->getKey() === $key) {
                return $head;
            }
            $head = $head->getNext();
        }
        return null;
    }

    /**
     * searches the list for a given key
     *
     * @param $key
     * @return bool
     */
    public function containsKey($key): bool {
        $node = $this->getHead();
        while ($node !== null) {
            if ($node->getKey() === $key) {
                return true;
            }
            $node = $node->getNext();
        }
        return false;
    }

    /**
     * removes a node from the list by a given key
     *
     * @param $key
     * @return bool
     */
    public function remove($key): bool {
        /** @var \doganoo\PHPAlgorithms\Datastructure\lists\Node $previous */
        $previous = $head = $this->getHead();
        if ($head === null) {
            return true;
        }
        $i = 1;
        $headSize = $head->size();

        /*
         * The while loop iterates over all nodes until the
         * value is found.
         */
        while ($head !== null && $head->getKey() !== $key) {
            /*
             * since a node is going to be removed from the
             * node chain, the previous element has to be
             * on hold.
             * After previous is set to the actual element,
             * the current element pointer can moved to the
             * next one.
             *
             * If the value is found, $previous points to
             * the previous element of the value that is
             * searched and current points to the next element
             * after that one who should be deleted.
             */
            $previous = $head;
            $head = $head->getNext();
            $i++;
        }

        /*
         * If the value that should be deleted is not in the list,
         * this set instruction assigns the next node to the actual.
         *
         * If the while loop has ended early, the next node is
         * assigned to the previous node of the node that
         * should be deleted (if there is a node present).
         */
        if ($head !== null) {
            $previous->setNext($head->getNext());
        }
        return $i !== $headSize;
    }

    /**
     * replaces a value for a key
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public function replaceValue($key, $value): bool {
        $replaced = false;
        $node = $this->getHead();
        while ($node !== null) {
            if ($node->getKey() === $key) {
                $node->setValue($value);
                $replaced = true;
            }
            $node = $node->getNext();
        }
        return $replaced;
    }

    /**
     * string representation of a LinkedList instance
     *
     * @return string
     */
    public function __toString() {
        $head = $this->getHead();
        $string = "";
        while ($head !== null) {
            $string .= $head . "\n";
            $head = $head->getNext();
        }
        return $string;
    }

    //protected function removeDuplicates() {
    //    $node = $this->head;
    //    $previous = $this->head;
    //    $visited = [];
    //
    //    while ($node !== null) {
    //        if (in_array($node->getValue(), $visited)) {
    //            $previous->setNext($node->getNext());
    //        } else {
    //            $visited[] = $node->getValue();
    //            $previous = $node;
    //        }
    //        $node = $node->getNext();
    //    }
    //}
}