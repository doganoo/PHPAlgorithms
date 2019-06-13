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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree;

use doganoo\PHPAlgorithms\Common\Exception\NoNodeFoundException;
use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinaryTree\BinarySearchNode;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\RedBlackTree\Node;
use doganoo\PHPUtil\Log\Logger;
use function foo\func;

/**
 * Class RedBlackTree
 * @package doganoo\PHPAlgorithms\Datastructure\Graph\Tree
 */
class RedBlackTree {
    private $root = null;

    public function getRoot():?Node{
        return $this->root;
    }
    public function insertBST(?Node $root, Node $node){
        if (null === $root) return $node;

        if ($node->getValue() < $root->getValue()){
            $root->setLeft(
                $this->insertBST($root->getLeft(), $node)
            );
            $root->getLeft()->setParent($root);
        } else if ($node->getValue() > $root->getValue()){
            $root->setRight(
                $this->insertBST($root->getRight(), $node)
            );
            $root->getRight()->setParent($root);
        }

        return $node;
    }
    public function insertValue($value): bool {
        $node = new Node($value);
        $this->insertBST($this->root, $node);
        $this->fixTreeProperties($node);
        return true;
    }

    public function insert(?IBinaryNode $node) {
        if (!$node instanceof Node) {
            return false;
        }
        if (null === $this->getRoot()) {
            $this->setRoot($node);
            parent::setSize(parent::getSize() + 1);
        }
        /** @var BinarySearchNode $current */
        $current = $this->getRoot();

        if (Comparator::lessThan($node->getValue(), $current->getValue())) {
            while (null !== $current->getLeft()) {
                $current = $current->getLeft();
            }
            $current->setLeft($node);
            $current->getLeft()->setParent($node);
            parent::setSize(parent::getSize() + 1);
        } else if (Comparator::greaterThan($node->getValue(), $current->getValue())) {
            while (null !== $current->getRight()) {
                $current = $current->getRight();
            }
            $current->setRight($node);
            $current->getRight()->setParent($node);
            parent::setSize(parent::getSize() + 1);
        }

        return false;

    }

    // TODO better function name
    private function fixTreeProperties(Node $node):bool {
        $parent = null;
        $grandParent = null;
        /** @var Node|null $root */
        $root = $this->getRoot();

        // TODO parents color could be null
        while (
            Comparator::notEquals($node, $root) &&
            Comparator::equals(Node::BLACK, $node->getColor()) &&
            Comparator::equals(Node::BLACK, $node->getParentsColor())
        ) {
            $parent = $node->getParent();
            $grandParent = null !== $parent ?
                $parent->getParent() :
                null;
            if (Comparator::equals($parent, $grandParent->getLeft())) {
                // TODO $uncle can be null
                /** @var Node|null $uncle */
                $uncle = $grandParent->getRight();

                if (Comparator::equals(Node::RED, $uncle->getColor())) {
                    $uncle->setColor(Node::BLACK);
                    $parent->setColor(Node::BLACK);
                    $grandParent->setColor(Node::RED);
                    $node = $grandParent;
                } else{

                    if (Comparator::equals($node, $parent->getRight())){
                        $this->rotateLeft($parent);
                        $node = $parent;
                        $parent = $node->getParent();
                    }

                    $this->rotateRight($grandParent);
                    $this->swapColors($parent, $grandParent);
                    $node = $parent;
                }

            } else if (Comparator::equals($parent, $grandParent->getRight())){
                $uncle = $grandParent->getLeft();
                if (Comparator::equals(Node::RED, $uncle->getColor())){
                    $uncle->setColor(Node::BLACK);
                    $parent->setColor(Node::BLACK);
                    $grandParent->setColor(Node::RED);
                    $node = $grandParent;
                }else{

                    if (Comparator::equals($node, $parent->getLeft())){
                        $this->rotateRight($parent);
                        $node = $parent;
                        $parent = $node->getParent();
                    }

                    $this->rotateRight($grandParent);
                    $this->swapColors($parent, $grandParent);
                    $node = $parent;
                }
            }else{
                throw new NoNodeFoundException();
            }

            $root->setColor(Node::BLACK);
        }
        return true;
    }

    private function rotateLeft(Node $node):void {
        $right = $node->getRight();
        $node->setRight($right->getLeft());

        if (null !== $node->getRight()){
            $node->getRight()->setParent($node);
        }

        $right->setParent($node->getParent());
        $right->setParent($node->getParent());

        if (null === $node->getParent()){
            $this->setRoot($right);
        } else if (Comparator::equals($node, $node->getParent()->getLeft())){
            $node->getParent()->setLeft($right);
        } else if (Comparator::equals($node, $node->getParent()->getRight())){
            $node->getParent()->setRight($right);
        } else {
            throw new NoNodeFoundException();
        }

        $right->setLeft($node);
        $node->setParent($right);
    }

    private function rotateRight(Node $node):void {
        $left = $node->getLeft();
        $node->setLeft($left->getRight());

        if (null !== $node->getLeft()){
            $node->getLeft()->setParent($node);
        }

        $left->setParent($node->getParent());

        if (null !== $node->getParent()){
            $this->setRoot($left);
        } else if (Comparator::equals($node, $node->getParent()->getLeft())){
            $node->getParent()->setLeft($left);
        } else if (Comparator::equals($node, $node->getParent()->getRight())){
            $node->getParent()->setRight($left);
        } else{
            throw new NoNodeFoundException();
        }

        $left->setRight($node);
        $node->setParent($left);
    }

    private function swapColors(Node $parent, Node $grandParent):void {
        $parentColor = $parent->getColor();
        $grandParentColor = $grandParent->getColor();
        $parent->setColor($grandParentColor);
        $grandParent->setColor($parentColor);
    }
}