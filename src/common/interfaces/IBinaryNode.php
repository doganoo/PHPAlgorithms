<?php


namespace doganoo\PHPAlgorithms\common\interfaces;


interface IBinaryNode {
    public function getValue();

    public function getLeft(): ?IBinaryNode;

    public function setLeft(?IBinaryNode $node): void;

    public function getRight(): ?IBinaryNode;

    public function setRight(?IBinaryNode $node): void;


}