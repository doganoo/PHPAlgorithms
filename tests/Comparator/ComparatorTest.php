<?php


use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Graph\Graph\Node;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;

class ComparatorTest extends \PHPUnit\Framework\TestCase {

    public function testComparator() {
        $node = new Node(1);
        $node2 = new Node(2);
        $this->assertTrue(Comparator::equals($node, $node2) === false);


        $node = new Node(1);
        $node2 = new Node(1);
        $this->assertTrue(Comparator::equals($node, $node2) === true);


        $node = new Node(1);
        $value = "test";
        $this->assertTrue(Comparator::equals($node, $value) === false);

        $node = "test";
        $value = "test";
        $this->assertTrue(Comparator::equals($node, $value) === true);

        $node = "1";
        $value = 1;
        $this->assertTrue(Comparator::equals($node, $value) === true);

        $node = new Node(1);
        $value = new ArrayList();
        $this->assertTrue(Comparator::equals($node, $value) === false);
    }

}