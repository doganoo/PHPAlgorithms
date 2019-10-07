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

use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\AVLTree\Node;

/**
 * Class AVLTree
 * @package doganoo\PHPAlgorithms\Datastructure\Graph\Tree
 *
 * TODO implement! Actually implemented the half way
 */
class AVLTree extends BinarySearchTree {

    public const BALANCE_VALUE_ONE = 1;
    public const BALANCE_VALUE_MINUS_ONE = -1;

    /**
     * @param Node $node
     * @return bool
     */
    public function insert(?IBinaryNode $node) {
        return false;
        if (false === $node instanceof Node) return false;

        $inserted = parent::insert($node);

        if (false === $inserted) return false;

        /** @var Node $root */
        $root = parent::getRoot();
        $value = $root->getValue();

        $balance = $root->getBalance();

        if ($balance > AVLTree::BALANCE_VALUE_ONE) {

            $childValue =
                null === $root->getLeft()
                    ? null
                    : $root->getLeft()->getValue()
            ;

            if (Comparator::lessThan($value, $childValue)) {
                $this->setRoot(
                    $this->rightRotate($root)
                );
                return true;
            }

            if (Comparator::greaterThan($value, $childValue)) {
                $root->setLeft(
                    $this->leftRotate($root->getLeft())
                );
                $this->setRoot(
                    $this->rightRotate($root)
                );
                return true;
            }
        }

        if ($balance < AVLTree::BALANCE_VALUE_MINUS_ONE){

            $this->log($balance);
            $childValue =
                null === $root->getRight()
                    ? null
                    : $root->getRight()->getValue()
            ;

            if (Comparator::greaterThan($value, $childValue)) {
                $this->setRoot(
                    $this->leftRotate($root)
                );
                return true;
            }

            if (Comparator::lessThan($value, $childValue)) {
                $root->setRight(
                    $this->rightRotate($root->getRight())
                );
                $this->setRoot(
                    $this->leftRotate($root)
                );

                return true;
            }

        }

        return true;
    }

    public function insertValue($value): bool {
        return false;
        $avlNode = new Node($value);
        return $this->insert($avlNode);
    }

    private function rightRotate(Node $y):Node {
        /** @var Node $x */
        $x = $y->getLeft();
        /** @var Node $t2 */
        $t2 = $x->getRight();

        $x->setRight($y);
        $y->setLeft($t2);

        return $x;
    }

    private function leftRotate(Node $x):Node{
        /** @var Node $y */
        $y = $x->getRight();
        /** @var Node $t2 */
        $t2 = $y->getLeft();

        $y->setLeft($x);
        $x->setRight($t2);

        return $y;
    }

}