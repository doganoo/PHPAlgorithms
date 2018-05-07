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

namespace doganoo\PHPAlgorithms\datastructure\Graph\Tree\Trie;


/**
 * Class Node
 *
 * @package doganoo\PHPAlgorithms\datastructure\trie
 */
class Node {
    private $value;
    private $children;

    /**
     * Node constructor.
     */
    public function __construct() {
        $this->children = [];
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value): void {
        $this->value = $value;
    }

    public function getChildNode(int $position): ?Node {
        if (isset($this->children[$position])) {
            return $this->children[$position];
        }
        return null;
    }

    public function createChildNode(int $position) {
        $node = new Node();
        $node->setValue($position);
        $this->children[$position] = $node;
    }

    public function createEndOfWordNode() {
        $this->children[] = new EndOfWordNode();
    }

    public function isEndOfNode() {
        return $this->children[0] instanceof EndOfWordNode;
    }
}