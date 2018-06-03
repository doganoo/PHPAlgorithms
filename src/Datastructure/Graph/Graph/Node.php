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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Graph;

use doganoo\PHPAlgorithms\Common\Interfaces\Comparable;
use doganoo\PHPAlgorithms\Common\Interfaces\INode;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;

/**
 * Class Node
 *
 * @package doganoo\PHPAlgorithms\Graph
 */
class Node implements Comparable, INode {
    private $value;
    private $adjacent = null;

    public function __construct($value) {
        $this->value = $value;
        $this->adjacent = new ArrayList();
    }

    public function addAdjacent(Node $node): bool {
        return $this->adjacent->add($node);
    }

    public function hasAdjacent(Node $node) {
        /**
         * @var      $key
         * @var Node $value
         */
        foreach ($this->adjacent as $key => $value) {
            if ($value->getValue() == $node->getValue()) {
                return true;
            }
        }
        return false;
    }

    public function getValue() {
        return $this->value;
    }

    public function equals(Node $node): bool {
        return Comparator::equals($this->value, $node->getValue());
    }

    public function getAdjacents(): ?ArrayList {
        return $this->adjacent;
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if (!$object instanceof Node) {
            return -1;
        }
        if ($this->getValue() < $object->getValue()) {
            return -1;
        }
        if ($this->getValue() == $object->getValue()) {
            return 0;
        }
        if ($this->getValue() > $object->getValue()) {
            return 1;
        }
        return -1;
    }
}