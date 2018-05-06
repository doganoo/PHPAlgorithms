<?php


class TrieTest extends \PHPUnit\Framework\TestCase {

    public function testAdd() {
        $trie = new \doganoo\PHPAlgorithms\datastructure\trie\Trie();
        $trie->insert("Test");
    }

}