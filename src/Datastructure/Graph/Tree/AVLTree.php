<?php


namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree;

use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\AVLTree\Node;

class AVLTree extends BinarySearchTree {

    /**
     * @param Node $node
     * @return bool
     */
    public function insert(?IBinaryNode $node) {
        if (false === $node instanceof Node) return false;

        $inserted = parent::insert($node);

        if (false === $inserted) return false;

        /** @var Node $root */
        $root = parent::getRoot();

        $balance = $root->getBalance();

        if ($balance > 1 && Comparator::lessThan($root->getValue(),$root->getLeft()->getValue())){
            $this->setRoot(
                $this->rightRotate($root)
            );
            return true;
        }

        if ($balance < -1 && Comparator::greaterThan($root->getValue(), $root->getRight()->getValue())){
            $this->setRoot(
                $this->leftRotate($root)
            );
            return true;
        }

        if ($balance > 1 && Comparator::greaterThan($root->getValue(),$root->getLeft()->getValue())){
            $root->setLeft(
                $this->leftRotate($root->getLeft())
            );
            $this->setRoot(
                $this->rightRotate($root)
            );
            return true;
        }

        if ($balance < -1 && Comparator::greaterThan($root->getValue(), $root->getRight()->getValue())){
            $root->setRight(
                $this->rightRotate($root->getRight())
            );
            $this->setRoot(
                $this->leftRotate($root)
            );

            return true;
        }


        return true;
    }

    public function insertValue($value): bool {
        $avlNode = new Node($value);
        return $this->insert($avlNode);
    }

    private function rightRotate(Node $node):Node{
        /** @var Node $x */
        $x = $node->getLeft();
        /** @var Node $t2 */
        $t2 = $x->getRight();

        $x->setRight($node);
        $node->setLeft($t2);

        $node->setHeight(
            max($node->getLeft()->getHeight(), $node->getRight()->getHeight()) +1
        );
        $x->setHeight(
            max($x->getLeft()->getHeight(), $x->getRight()->getHeight()) +1
        );

        return $x;
    }

    private function leftRotate(Node $node):Node{
        /** @var Node $y */
        $y = $node->getRight();
        /** @var Node $t2 */
        $t2 = $y->getLeft();

        $y->setLeft($node);
        $node->setRight($t2);

        $node->setHeight(
            max($node->getLeft()->getHeight(), $node->getRight()->getHeight()) +1
        );
        $y->setHeight(
            max($y->getLeft()->getHeight(), $y->getRight()->getHeight()) +1
        );

        return $y;
    }

}