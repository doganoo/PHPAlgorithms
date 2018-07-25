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
}