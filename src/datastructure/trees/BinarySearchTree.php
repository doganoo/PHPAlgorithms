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

namespace doganoo\PHPAlgorithms\datastructure\trees;


use doganoo\PHPAlgorithms\datastructure\trees\BinaryTree\BinarySearchNode;

/**
 * Class BinarySearchTree
 *
 * @package doganoo\PHPAlgorithms\datastructure\trees
 */
class BinarySearchTree {
    /** @var BinarySearchNode|null */
    private $root = null;

    /**
     * returns the height
     *
     * @return int
     */
    public function height(): int {
        return $this->_height($this->getRoot());
    }

    /**
     * helper method
     *
     * @param BinarySearchNode|null $node
     * @return int
     */
    private function _height(?BinarySearchNode $node): int {
        if (null === $node) {
            return 0;
        }
        return 1 + \max($this->_height($node->getLeft()), $this->_height($node->getRight()));
    }

    /**
     * @return null
     */
    public function getRoot() {
        return $this->root;
    }

    /**
     * @param null $root
     */
    public function setRoot($root): void {
        $this->root = $root;
    }

    /**
     * inserts a new value
     *
     * @param int $value
     * @return bool
     */
    public function insert(int $value): bool {
        if (null === $this->getRoot()) {
            $this->setRoot(new BinarySearchNode($value));
            return true;
        }
        /** @var BinarySearchNode $current */
        $current = $this->getRoot();
        if ($value < $current->getValue()) {
            while (null !== $current->getLeft()) {
                $current = $current->getLeft();
            }
            $current->setLeft(new BinarySearchNode($value));
            return true;
        } else if ($value > $current->getValue()) {
            while (null !== $current->getRight()) {
                $current = $current->getRight();
            }
            $current->setRight(new BinarySearchNode($value));
            return true;
        }
        return false;
    }

    /**
     * searches a value
     *
     * @param $value
     * @return BinarySearchNode|null
     */
    public function search($value): ?BinarySearchNode {
        /** @var BinarySearchNode $node */
        $node = $this->getRoot();
        while (null !== $node) {
            if ($value === $node->getValue()) {
                return $node;
            } else if ($value < $node->getValue()) {
                $node = $node->getLeft();
            } else if ($value > $node->getValue()) {
                $node = $node->getRight();
            }
        }
        return null;
    }
}