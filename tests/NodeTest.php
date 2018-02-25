<?php


use doganoo\PHPAlgorithms\Maps\Node;

class NodeTest extends \PHPUnit\Framework\TestCase {
    public function testNodeReference() {
        $a = new Node();
        $a->setKey(1);
        $a->setValue("1");

        $b = new Node();
        $b->setKey(2);
        $b->setValue("2");

        $c = new Node();
        $c->setKey(3);
        $c->setValue("3");

        $b->setNext($c);
        $a->setNext($b);

        $d = $a;
        $d = $d->getNext();
        $this->assertTrue($d->size() == 2);
        $this->assertTrue($a->size() == 3);
    }


}
