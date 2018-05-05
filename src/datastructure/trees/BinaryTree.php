<?php


namespace doganoo\PHPAlgorithms\datastructure\trees;


use doganoo\PHPAlgorithms\Algorithm\Traversal\InOrder;
use doganoo\PHPAlgorithms\common\interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\common\interfaces\IBinaryTree;
use doganoo\PHPAlgorithms\datastructure\trees\BinaryTree\BinaryNode;

class BinaryTree implements IBinaryTree {
    /** @var IBinaryNode|null $root */
    private $root = null;

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

    public function getRoot(): ?IBinaryNode {
        return $this->root;
    }

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