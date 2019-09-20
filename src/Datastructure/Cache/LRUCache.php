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

namespace doganoo\PHPAlgorithms\Datastructure\Cache;


use doganoo\PHPAlgorithms\Common\Interfaces\ICache;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Table\HashTable;

/**
 * Class LRUCache
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Cache
 */
class LRUCache implements ICache {
    /** @var HashTable|null $hashMap */
    private $hashMap = null;
    /** @var Node $head */
    private $head = null;
    /** @var int $capacity */
    private $capacity = 0;

    /**
     * LRUCache constructor.
     *
     * @param int $capacity
     */
    public function __construct($capacity = 128) {
        $this->hashMap = new HashTable();
        $this->capacity = $capacity;
    }

    /**
     * adds a new key value pair
     *
     * @param $key
     * @param $value
     * @return bool
     * @throws \doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException
     */
    public function put($key, $value): bool {
        if ($this->hashMap->containsKey($key)) {
            $node = $this->getNodeFromHead($key);
            $node->setKey($key);
            $node->setValue($value);
            $this->unset($node);
            $this->updateHead($node);
            return true;
        }
        if ($this->hashMap->size() >= $this->capacity) {
            $end = $this->getEnd();
            if (null !== $end) {
                $this->unset($end);
                $this->hashMap->remove($end->getKey());
            }
        }
        $node = new Node();
        $node->setKey($key);
        $node->setValue($value);
        $this->updateHead($node);
        $this->hashMap->add($key, $value);
        return true;
    }

    private function getNodeFromHead($key) {
        $head = $this->head;
        while (null !== $head) {
            if (Comparator::equals($head->getKey(), $key)) {
                return $head;
            }
            $head = $head->getNext();
        }
        return null;
    }

    /**
     * @param Node $node
     */
    private function unset(Node $node) {
        if (null === $node) {
            return;
        }
        if (Comparator::equals($this->head, $node)) {
            $this->head = $node->getNext();
        }
        if (null !== $node->getNext()) {
            $node->getNext()->setPrevious($node->getPrevious());
        }
        if (null !== $node->getPrevious()) {
            $node->getPrevious()->setNext($node->getNext());
        }
        unset($node);
    }

    /**
     * @param Node $node
     */
    private function updateHead(Node $node) {
        $node->setPrevious(null);
        $node->setNext($this->head);

        if (null !== $this->head) {
            $this->head->setPrevious($node);
        }
        $this->head = $node;
    }

    /**
     * @return Node|null
     */
    private function getEnd(): ?Node {
        $head = $this->head;
        if (null === $head) {
            return null;
        }
        while (null !== $head->getNext()) {
            $head = $head->getNext();
        }
        return $head;
    }

    /**
     * retrieves a value
     *
     * @param $key
     * @return mixed
     */
    public function get($key) {
        if ($this->hashMap->containsKey($key)) {
            $node = $this->getNodeFromHead($key);
            $this->unset($node);
            $this->updateHead($node);
            return $this->head->getValue();
        }
        return null;
    }

    /**
     * returns the last accessed, non-deleted value
     *
     * @return mixed|null
     */
    public function last() {
        if (null === $this->head) return null;
        return $this->head->getKey();
    }

    /**
     * deletes a given key
     *
     * @param $key
     * @return bool
     * @throws \doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException
     */
    public function delete($key): bool {
        $node = $this->getNodeFromHead($key);
        if (null === $node) {
            return false;
        }
        /** @var Node $head */
        $head = $this->head;
        while (null !== $head) {
            if (Comparator::equals($head->getKey(), $node->getKey())) {
                $this->unset($head);
                $this->hashMap->remove($key);
                return true;
            }
            $head = $head->getNext();
        }
        return false;
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof LRUCache) {
            if (Comparator::equals($this->hashMap, $object->hashMap)) return 0;
            if (Comparator::lessThan($this->hashMap, $object->hashMap)) return -1;
            if (Comparator::greaterThan($this->hashMap, $object->hashMap)) return 1;
        }
        return -1;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            "map" => $this->hashMap
            , "head" => $this->head
            , "capacity" => $this->capacity,
        ];
    }
}