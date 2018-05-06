<?php


namespace doganoo\PHPAlgorithms\datastructure\trie;


class Trie {
    private $root;

    public function __construct() {
        $this->root = new RootNode();
    }

    public function insert(string $string) {
        $node = $this->root;
        for ($i = 0; $i < \strlen($string); $i++) {
            //$position = \ord($string[$i]) - \ord("a");
            $position = \ord($string[$i]);
            if (null === $node->getChildNode($position)) {
                $created = $node->createChildNode($position);
            }
            $node = $node->getChildNode($position);
        }
    }
}