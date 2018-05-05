<?php


namespace doganoo\PHPAlgorithms\common\interfaces;


interface IBinaryTree {

    public function getRoot(): ?IBinaryNode;

    public function insert(?IBinaryNode $node);
}