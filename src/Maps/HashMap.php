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

namespace doganoo\PHPAlgorithms\Maps;

/**
 * HashMap class - implementation of a map using hashes in order to avoid collisions
 *
 * Class HashMap
 *
 * @package doganoo\PHPAlgorithms\Maps
 */
class HashMap {
    /**
     * @var array $bucket the buckets containing the nodes
     */
    private $bucket = null;

    /**
     * @var int $maxSize the maximum number of buckets
     */
    private $maxSize = 128;

    /**
     * HashMap constructor creates an empty array.
     */
    public function __construct() {
        $this->bucket = [];
    }


    /**
     * adds a new value assigned to a key. The key has to be a scalar
     * value otherwise the method throws an InvalidKeyTypeException.
     *
     * TODO catch exception
     *
     * @param $key
     * @param $value
     * @throws \doganoo\PHPAlgorithms\Exception\InvalidKeyTypeException
     * @return bool
     */
    public function add($key, $value): bool {
        /*
         * first, the keys hash is calculated by a
         * private method. Next, the array index
         * (bucket index) is calculated from this hash.
         *
         * Doing this avoids hash collisions.
         */
        $hash = $this->getHash($key);
        $arrayIndex = $this->getArrayIndex($hash);
        /** @var Node $head */
        $head = null;

        if ($this->contains($value)) {
            //if the key is already in the list, then ignore
            //TODO better override?
            return true;
        }

        //query the head if it is available in the bucket list
        if (isset($this->bucket[$arrayIndex])) {
            $head = $this->bucket[$arrayIndex];
        }
        /*
         * if the head is not available in the bucket list
         * create a new one, add it to the bucket list
         * and return true
         */
        if ($head === null) {
            $head = new Node();
            $head->setKey($key);
            $head->setValue($value);
            $this->bucket[$arrayIndex] = $head;
            return true;
        }

        /*
         * if there is is already a head, check first if
         * the key is already in the node list.
         */
        if ($head !== null) {
            //first check if there is already a node with the given key
            //if yes: do not create a new Node and simply overwrite
            //if not: create a new node and add it to the top of the node list
            if ($this->checkForDuplicate($head, $key)) {
                $head->setValue($value);
                $this->bucket[$arrayIndex] = $head;
            } else {
                $newNode = new Node();
                $newNode->setKey($key);
                $newNode->setValue($value);
                $newNode->setNext($head);
                $this->bucket[$arrayIndex] = $newNode;
            }
            return true;
        }
        return true;
    }

    /**
     * returns the hash that is used to calculate the
     * bucket index.
     *
     * @param $key
     * @return int
     */
    private function getHash($key): int {
        return crc32($key);
    }

    /**
     * calculates the bucket index for a given hash
     *
     * @param int $hash
     * @return int
     */
    private function getArrayIndex(int $hash): int {
        return $hash % $this->maxSize;
    }

    /**
     * determines whether the HashMap contains a value.
     *
     * TODO improvement suggestion: get the appropriate bucket and search only in this bucket
     *
     * @param $value
     * @return bool
     */
    public function contains($value): bool {
        //TODO check more instance types
        if ($value instanceof Node) {
            $value = $value->getValue();
        }

        /**
         * @var string $arrayIndex
         * @var Node   $node
         */
        foreach ($this->bucket as $arrayIndex => $node) {
            /* the node ist assigned to a temporary variable
             * in order to loop over the while loop.
             *
             * $node is the first element in the bucket. The bucket
             * can contain max $maxSize entries and each entry has zero
             * or one nodes which can have zero, one or multiple
             * successors.
             *
             * The $tmp variable is used to iterate over an entire
             * bucket before jumping to the next.
             */
            $tmp = $node;
            while ($tmp !== null) {
                //return true if the searched value is found
                if ($tmp->getValue() == $value) {
                    return true;
                }
                //get the next node
                $tmp = $tmp->getNext();
            }
        }
        /*
         * If no bucket contains the value then return false because
         * the searched value is not in the list.
         */
        return false;
    }

    /**
     * checks whether a given key is available in a node.
     *
     * TODO remove parameter node and check the bucket list?
     *
     * @param Node $node
     * @param int  $key
     * @return bool
     */
    private function checkForDuplicate(Node $node, int $key) {
        if ($node->getNext() !== null) {
            return $this->checkForDuplicate($node->getNext(), $key);
        }
        if ($node->getKey() === $key) {
            return true;
        }
        return false;
    }

    /**
     * this method returns the node if it is presentable in the list or null, if not.
     *
     * TODO improvement suggestion: get the appropriate bucket and search only in this bucket
     *
     * @param $value
     * @return Node|null
     */
    public function getNodeByValue($value): ?Node {
        //TODO check more instance types
        if ($value instanceof Node) {
            $value = $value->getValue();
        }
        /**
         * @var string $arrayIndex
         * @var Node   $node
         */
        foreach ($this->bucket as $arrayIndex => $node) {
            /* the node ist assigned to a temporary variable
             * in order to loop over the while loop.
             *
             * $node is the first element in the bucket. The bucket
             * can contain max $maxSize entries and each entry has zero
             * or one nodes which can have zero, one or multiple
             * successors.
             *
             * The $tmp variable is used to iterate over an entire
             * bucket before jumping to the next.
             */
            $tmp = $node;
            while ($tmp !== null) {
                if ($tmp->getValue() == $value) {
                    //if the value is found then return it
                    return $tmp;
                }
                $tmp = $tmp->getNext();
            }
        }
        //return null if there is no value
        return null;
    }

    /**
     * removes a given value from the node list
     *
     * @param $value
     * @return bool
     */
    public function remove($value): bool {
        //TODO check more instance types
        if ($value instanceof Node) {
            $value = $value->getValue();
        }
        /**
         * @var string $arrayIndex
         * @var Node   $node
         */
        foreach ($this->bucket as $arrayIndex => $node) {

            /**
             * first, the nodes are initialized equally to the
             * head of the bucket.
             *
             * @var Node $current
             */
            $current = $previous = $node;

            /*
             * The while loop iterates over all nodes until the
             * value is found.
             *
             * TODO schauen, ob $current !== null ist
             */
            while ($current->getValue() != $value) {
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
                $previous = $current;
                $current = $current->getNext();
            }

            /*
             * If the value that should be deleted is not in the list,
             * this set instruction assigns the next node to the actual.
             *
             * If the while loop has ended early, the next node is
             * assigned to the previous node of the node that
             * should be deleted.
             */
            $previous->setNext($current->getNext());
        }
        //TODO determine if the value has been removed or not
        return true;
    }
}