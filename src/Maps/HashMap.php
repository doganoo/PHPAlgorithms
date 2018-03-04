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

use doganoo\PHPAlgorithms\Util\MapUtil;

/**
 * HashMap class - implementation of a map using hashes in order to avoid collisions
 *
 * If you want to read more about the theory behind visit: https://dogan-ucar.de/php-hashmap-implementation/
 *
 * Class HashMap
 *
 * TODO implement entrySet
 * TODO implement values
 * TODO implement Java-like generics for key and value
 * TODO (optional) implement universal hashing
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
        $this->initializeBucket();
    }

    /**
     * initializes the bucket in setting the
     * bucket attribute to an empty array.
     */
    private function initializeBucket() {
        $this->bucket = [];
    }

    /**
     * adds a node to the hash map
     *
     * @param Node $node
     * @return bool
     * @throws \doganoo\PHPAlgorithms\Exception\InvalidKeyTypeException
     */
    public function addNode(Node $node): bool {
        $added = $this->add($node->getKey(), $node->getValue());
        return $added;
    }

    /**
     * adds a new value assigned to a key. The key has to be a scalar
     * value otherwise the method throws an InvalidKeyTypeException.
     *
     * @param $key
     * @param $value
     * @return bool
     */
    public function add($key, $value): bool {
        $arrayIndex = $this->getBucketIndex($key);
        $key = MapUtil::normalizeKey($key);
        /** @var Node $head */
        $head = null;

        /*
         * the method checks the value if it is already
         * in the map or not.
         *
         * Notice that contains() looks for the value, not
         * key as below.
         */
        if ($this->containsValue($value)) {
            //if the key is already in the list, then ignore
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

        //first check if there is already a node with the given key
        //if yes: do not create a new Node and simply overwrite
        //if not: create a new node and add it to the top of the node list
        $headContainsKey = $this->containsKey($head, $key);
        if ($headContainsKey) {
            $replacedNode = $this->replaceValue($head, $key, $value);
            if ($replacedNode !== null) {
                $this->bucket[$arrayIndex] = $replacedNode;
                return true;
            }
            return false;
        } else {
            $newNode = new Node();
            $newNode->setKey($key);
            $newNode->setValue($value);
            $newNode->setNext($head);
            $this->bucket[$arrayIndex] = $newNode;
        }
        return true;
    }

    /**
     * returns the bucket array index by using the "division method".
     *
     * note that the division method has limitations: if the hash function
     * calculates the hashes in a constant way, the way how keys are created
     * can be chosen so that they hash to the same bucket. Thus, the worst-case
     * scenario of having n nodes in one chain would be true.
     * Solution: use universal hashing
     *
     * @param $key
     * @return int
     */
    private function getBucketIndex($key) {
        /*
         * first, it must be ensured that the
         * key is an integer.
         */
        $key = MapUtil::normalizeKey($key);
        /*
         * next, the keys hash is calculated by a
         * private method. Next, the array index
         * (bucket index) is calculated from this hash.
         *
         * Doing this avoids hash collisions.
         */
        $hash = $this->getHash($key);
        $arrayIndex = $this->getArrayIndex($hash);
        return $arrayIndex;
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
     * @param $value
     * @return bool
     */
    public function containsValue($value): bool {

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
     * @param Node $node
     * @param int  $key
     * @return bool
     */
    private function containsKey(Node $node, int $key) {
        if ($node->getNext() !== null) {
            return $this->containsKey($node->getNext(), $key);
        }
        if ($node->getKey() === $key) {
            return true;
        }
        return false;
    }

    private function replaceValue(Node $node, $key, $value): Node {
        $newNode = $node;
        while ($node !== null) {
            if ($node->getKey() === $key) {
                $node->setValue($value);
            }
            $node = $node->getNext();
            $newNode->setNext($node);
        }
        return $newNode;
    }

    /**
     * this method returns the node if it is presentable in the list or null, if not.
     * Please note: this method returns the first node that has the occurrence of the value
     *
     *
     * @param $value
     * @return Node|null
     */
    public function getNodeByValue($value): ?Node {
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

    public function get($key): ?Node {
        $arrayIndex = $this->getBucketIndex($key);
        /*
         * the head is requested from the array based on
         * the array index hash.
         */
        /** @var Node $head */
        $head = $this->bucket[$arrayIndex];

        /*
         * iterate over the head until it is null.
         * If a value is found, return the node (head).
         * If not, the loop terminates and the method
         * returns null.
         */
        while ($head !== null) {
            if ($head->getKey() === $key) {
                return $head;
            }
            $head = $head->getNext();
        }
        /*
         * this line is only reached when the node
         * does not contain the key
         */
        return null;
    }

    /**
     * removes a node by a given key
     *
     * @param $key
     * @return bool
     */
    public function remove($key): bool {
        //get the corresponding index to key
        $arrayIndex = $this->getBucketIndex($key);

        /*
         *if the array index is not available in the
         * bucket list, end the method and return true.
         * True due to the operation was successful, meaning
         * that $key is not in the list.
         * False would indicate that there was an error
         * and the node is still in the list
         */
        if (!isset($this->bucket[$arrayIndex])) {
            return true;
        }

        /** @var Node $previous */
        /** @var Node $head */
        $previous = $head = $this->bucket[$arrayIndex];
        $i = 1;
        $headSize = $head->size();
        /*
         * there is one special case for the HashMap:
         * if there is only one node in the bucket, then
         * check if the nodes key equals to the key that
         * should be deleted.
         * If this is the case, set the bucket to null
         * because the only one node is removed.
         * If this is not the key, return false as there
         * is no node to remove.
         */
        if ($head->size() == 1) {
            if ($head->getKey() === $key) {
                $this->bucket[$arrayIndex] = null;
                return true;
            }
            return false;
        }

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
         * should be deleted.
         */
        $previous->setNext($head->getNext());
        return $i !== $headSize;
    }

    /**
     * removes all buckets and their nodes.
     */
    public function clear() {
        $this->initializeBucket();
    }

    /**
     * basic implementation of Java-like keySet().
     * The method returns an array containing the node keys.
     *
     * TODO return (java like generic) set object
     *
     * @return array
     */
    public function keySet(): array {
        $keySet = [];
        /** @var Node $head */
        foreach ($this->bucket as $head) {
            while ($head !== null) {
                $keySet[] = $head->getKey();
                $head = $head->getNext();
            }
        }
        return $keySet;
    }

}