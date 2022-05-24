<?php
declare(strict_types=1);
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


use doganoo\PHPAlgorithms\Common\Exception\InvalidSearchComparisionException;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\RedBlackTree\Node;

/**
 * Class RedBlackTree
 * @package doganoo\PHPAlgorithms\Datastructure\Graph\Tree
 *
 * TODO implement
 */
class RedBlackTree {

    /** @var Node|null $root */
    private ?Node $root = null;

    public function insertValue($value): void {
        return;
        $node = new Node($value);
        $this->insert($node);
    }

    public function getRoot(): ?Node {
        return $this->root;
    }

    public function setRoot(Node $root): void {
        $this->root = $root;
    }

    private function insert(Node $node) {
        $y = null;
        $x = $this->getRoot();

        while (null !== $x) {

            $y = $x;

            if (Comparator::lessThan($node->getValue(), $x->getValue())) {
                $x = $x->getLeft();
            } else if (Comparator::greaterThanEqual($node->getValue(), $x->getValue())) {
                $x = $x->getRight();
            } else {
                throw new InvalidSearchComparisionException("no comparision returned true. Maybe you passed different data types (scalar, object)?");
            }
        }

        $node->setParent($y);

        if (null === $y) {
            $this->setRoot($node);
        } else if (Comparator::lessThan($node->getValue(), $y->getValue())) {
            $y->setLeft($node);
        } else if (Comparator::greaterThanEqual($node->getValue(), $y->getValue())) {
            $y->setRight($node);
        } else {
            throw new InvalidSearchComparisionException("no comparision returned true. Maybe you passed different data types (scalar, object)?");
        }

        $this->fixUp($node);
    }

    private function fixUp(Node $node): void {

        while (Comparator::equals($node->getParentsColor(), Node::RED)) {

            if (Comparator::equals($node->getParent(), $node->getUncle(Node::SIDE_LEFT))) {

                $y = $node->getUncle(Node::SIDE_RIGHT);

                if (Comparator::equals(Node::RED, $y->getColor())) {

                    $node->setParentsColor(Node::BLACK);
                    $y->setColor(Node::BLACK);
                    $node->setGrandParentsColor(Node::RED);

                    $node = $node->getGrandParent();

                } else if (Comparator::equals($node, $node->getParent()->getRight())) {

                    $node = $node->getParent();
                    $this->leftRotate($node);

                } else {

                    $node->setParentsColor(Node::BLACK);
                    $node->setGrandParentsColor(Node::RED);
                    $this->rightRotate($node->getGrandParent());

                }

            } else if (Comparator::equals($node->getParent(), $node->getUncle(Node::SIDE_RIGHT))) {

                echo "right";
                echo "\n";

                $y = $node->getUncle(Node::SIDE_LEFT);

                if (Comparator::equals(Node::RED, $y->getColor())) {
                    $node->setParentsColor(Node::BLACK);
                    $y->setColor(Node::BLACK);
                    $node->setGrandParentsColor(Node::RED);
                    $node = $node->getGrandParent();
                } else if (Comparator::equals($node, $node->getParent()->getLeft())) {

                    $node = $node->getParent();
                    $this->rightRotate($node);

                } else {
                    $node->setParentsColor(Node::BLACK);
                    $node->setGrandParentsColor(Node::RED);
                    $this->leftRotate($node->getGrandParent());
                }
            } else {
//                throw new InvalidSearchComparisionException("no comparision returned true. Maybe you passed different data types (scalar, object)?");
            }

        }
        $this->getRoot()->setColor(Node::BLACK);
    }

    private function leftRotate(Node $x): void {
        // TODO implement
    }

    private function rightRotate(Node $node): void {
        // TODO implement
    }

}