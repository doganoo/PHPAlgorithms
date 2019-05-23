<?php


namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree\AVLTree;


use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinaryTree\BinarySearchNode;

class Node extends BinarySearchNode {

    public function setLeft(?IBinaryNode $left): void {
        if (false === $left instanceof Node) return;
        parent::setLeft($left);
    }

    public function setRight(?IBinaryNode $right): void {
        if (false === $right instanceof Node) return;
        parent::setRight($right);
    }

    public function getBalance():int{
        $leftHeight = (null === $this->getLeft()) ? 0 : $this->getLeft()->getHeight();
        $rightHeight = (null === $this->getRight()) ? 0 : $this->getRight()->getHeight();
        $result = (int)$leftHeight - (int)$rightHeight;
        return $result;
    }

}