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

namespace doganoo\PHPAlgorithms\datastructure\Graph\Tree;

use doganoo\PHPAlgorithms\Algorithm\Traversal\InOrder;
use doganoo\PHPAlgorithms\common\interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\common\interfaces\IBinaryTree;
use doganoo\PHPAlgorithms\datastructure\Graph\Tree\BinaryTree\BinaryNode;

/**
 * Class BinaryTree
 *
 * @package doganoo\PHPAlgorithms\datastructure\Graph\Tree
 */
class BinaryTree implements IBinaryTree {
    /** @var IBinaryNode|null $root */
    private $root = null;

    /**
     * @param int $value
     * @return bool
     */
    public function insertValue(int $value) {
        return $this->insert(new BinaryNode($value));
    }

    /**
     * inserts a new value
     *
     * TODO find the right way of insertion - currently acting as a BST
     *
     * @param IBinaryNode|null $node
     * @return bool
     */
    public function insert(?IBinaryNode $node) {
        if (!$node instanceof BinaryNode) {
            return false;
        }
        if (null === $this->getRoot()) {
            $this->root = $node;
            return true;
        }
        /** @var BinaryNode $current */
        $current = $this->getRoot();
        if ($node->getValue() < $current->getValue()) {
            while (null !== $current->getLeft()) {
                $current = $current->getLeft();
            }
            $current->setLeft($node);
            return true;
        } else if ($node->getValue() > $current->getValue()) {
            while (null !== $current->getRight()) {
                $current = $current->getRight();
            }
            $current->setRight($node);
            return true;
        }
        return false;
    }

    /**
     * @return IBinaryNode|null
     */
    public function getRoot(): ?IBinaryNode {
        return $this->root;
    }

    /**
     * @param $value
     * @return null
     */
    public function search($value) {
        $node = null;
        $traversal = new InOrder($this);
        $traversal->setCallable(function ($val) use ($value, &$node) {
            if ($value === $val) {
                $node = new BinaryNode($value);
            }
        });
        $traversal->traverse();
        return $node;
    }
}