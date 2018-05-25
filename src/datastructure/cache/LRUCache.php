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

namespace doganoo\PHPAlgorithms\datastructure\cache;


use doganoo\PHPAlgorithms\common\interfaces\ICache;
use doganoo\PHPAlgorithms\Datastructure\Lists\Node;
use doganoo\PHPAlgorithms\Datastructure\Maps\HashMap;

/**
 * Class LRUCache
 *
 * @package doganoo\PHPAlgorithms\datastructure\cache
 */
class LRUCache implements ICache {
    const SIZE = 2;
    private $map = null;
    private $head = null;
    private $tail = null;
    private $currSize = 0;

    /**
     * LRUCache constructor.
     */
    public function __construct() {
        $this->map = new HashMap();
    }

    /**
     * adds a new key value pair
     *
     * @param $key
     * @param $value
     * @return bool
     * @throws \ReflectionException
     * @throws \doganoo\PHPAlgorithms\Common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\Common\Exception\UnsupportedKeyTypeException
     */
    public function put($key, $value) {
        if ($this->map->containsKey($key)) {
            return false;
        }
        $this->map->add($key, $value);
        $node = new Node();
        $node->setValue($value);
        $node->setPrevious(null);
        if (null === $this->head) {
            $node->setNext(null);
        } else {
            $node->setNext($this->head);
        }
        $this->head = $node;
    }

    /**
     * retrieves a value
     *
     * @param $key
     * @return mixed
     */
    public function get($key) {
        if (!$this->map->containsKey($key)) {
            return null;
        }
        /** @var Node $node */
        $node = $this->head;
        $next = $node->getNext();
        $prev = $node->getPrevious();
        $prev->setNext($next);

        if (null !== $next) {
            $next->setPrevious($prev);
        }

        $node->setPrevious(null);
        $node->setNext($this->head);
        $this->head = $node;
    }

    /**
     * returns the last accessed, non-deleted value
     *
     * @return mixed
     */
    public function last() {
        // TODO: Implement last() method.
    }

    /**
     * deletes a given key
     *
     * @param $key
     * @return bool
     */
    public function delete($key): bool {
        // TODO: Implement delete() method.
    }
}