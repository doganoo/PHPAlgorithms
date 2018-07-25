<?php


namespace StackQueue;


use doganoo\PHPAlgorithms\Datastructure\Stackqueue\StackSet;

class StackSetTest extends \PHPUnit\Framework\TestCase {
    public function testStackSet() {
        $stackSet = new StackSet(2);
        $stackSet->push("Hallo");
        $stackSet->push("Hallo 2");
        $this->assertTrue($stackSet->stackCount() === 1);
        $stackSet->push("Hallo 3");
        $this->assertTrue($stackSet->stackCount() === 2);
        $element = $stackSet->pop();
        $this->assertTrue($element === "Hallo 3");
        $this->assertTrue($stackSet->stackCount() === 1);
    }

    public function testHugeStackSet() {
        $setSize = 1024;
        $factor = 4;
        $stackSet = new StackSet(1024);
        for ($i = 0; $i < $setSize * $factor; $i++) {
            $stackSet->push($i);
        }
        $this->assertTrue($stackSet->stackCount() === $factor);
        for ($i = 0; $i < $setSize + 1; $i++) {
            $stackSet->pop();
        }
        $this->assertTrue($stackSet->stackCount() === 3);
    }
}