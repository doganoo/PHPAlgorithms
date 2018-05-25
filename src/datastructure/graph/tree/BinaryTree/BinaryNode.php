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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinaryTree;

use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;

/**
 * Class BinaryNode
 *
 * @package doganoo\PHPAlgorithms\datastructure\Graph\Tree\BinaryTree
 */
class BinaryNode implements IBinaryNode {
    private $value = PHP_INT_MIN;
    private $left = null;
    private $right = null;

    /**
     * Node constructor.
     *
     * @param $value
     */
    public function __construct($value) {
        $this->value = $value;
    }

    /**
     * @return IBinaryNode|null
     */
    public function getLeft(): ?IBinaryNode {
        return $this->left;
    }

    /**
     * @param IBinaryNode|null $left
     */
    public function setLeft(?IBinaryNode $left): void {
        $this->left = $left;
    }

    /**
     * @return IBinaryNode|null
     */
    public function getRight(): ?IBinaryNode {
        return $this->right;
    }

    /**
     * @param IBinaryNode|null $right
     */
    public function setRight(?IBinaryNode $right): void {
        $this->right = $right;
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if (!$object instanceof BinaryNode) {
            return -1;
        }
        if ($this->getValue() < $object->getValue()) {
            return -1;
        }
        if ($this->getValue() === $object->getValue()) {
            return 0;
        }
        if ($this->getValue() > $object->getValue()) {
            return 1;
        }
        return -1;
    }

    /**
     * @return int
     */
    public function getValue(): int {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void {
        $this->value = $value;
    }
}