<?php

namespace doganoo\PHPAlgorithms\Common\Abstracts;

use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;

abstract class AbstractBinaryNode extends AbstractNode implements IBinaryNode {
    /** @var AbstractBinaryNode $right */
    private $right = null;
    /** @var AbstractBinaryNode $left */
    private $left = null;

    public function __construct($value = null) {
//        parent::setValue(PHP_INT_MIN);
        parent::__construct($value);
    }

    /**
     * @return IBinaryNode|null
     */
    public function getLeft(): ?IBinaryNode{
        return $this->left;
    }

    /**
     * @param IBinaryNode|null $node
     */
    public function setLeft(?IBinaryNode $node): void{
        $this->left = $node;
    }

    /**
     * @return IBinaryNode|null
     */
    public function getRight(): ?IBinaryNode{
        return $this->right;
    }

    /**
     * @param IBinaryNode|null $node
     */
    public function setRight(?IBinaryNode $node): void{
        $this->right = $node;
    }

    public function jsonSerialize() {
        return array_merge(
            parent::jsonSerialize()
            , [
                "left" => $this->getLeft()
                , "right" => $this->getRight()
            ]
        );
    }

}