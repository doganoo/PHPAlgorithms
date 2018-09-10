<?php


use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\StringBuilder;

class StringBuilderTest extends \PHPUnit\Framework\TestCase {

    public function testConstructor() {
        $nullStringBuilder = new StringBuilder();
        $this->assertTrue($nullStringBuilder->capacity() === 0);
        $this->assertTrue($nullStringBuilder == "");

        $stringBuilder = new StringBuilder("phpalgorithms");
        $this->assertTrue($stringBuilder->capacity() === 13);
        $this->assertTrue($stringBuilder == "phpalgorithms");

        $intStringBuilder = new StringBuilder(10);
        $this->assertTrue($intStringBuilder->capacity() === 10);
        $this->assertTrue($intStringBuilder == "");
    }

    public function testAppend() {
        $stringBuilder = new StringBuilder();
        $stringBuilder->append("p");
        $stringBuilder->append("h");
        $stringBuilder->append("p");
        $this->assertTrue($stringBuilder->length() === 3);
        $this->assertTrue($stringBuilder == "php");
        $this->assertTrue($stringBuilder->charAt(1) === "h");

        $stringBuilder = new StringBuilder();
        $stringBuilder->append("p");
        $stringBuilder->append("h");
        $stringBuilder->append("p");
        $stringBuilder->insert(1, "tes");
        $this->assertTrue($stringBuilder->capacity() === 4);
        $this->assertTrue($stringBuilder->charAt(1) === "t");
    }

    public function testReverse() {
        $stringBuilder = new StringBuilder();
        $stringBuilder->append("phpalgorithms");
        $stringBuilder = $stringBuilder->reverse();
        $this->assertTrue($stringBuilder == "smhtiroglaphp");
    }

    public function testDelete() {
        $stringBuilder = new StringBuilder();
        $stringBuilder->append("p");
        $stringBuilder->append("h");
        $stringBuilder->append("p");
        $stringBuilder->delete(0, 1);
        $this->assertTrue($stringBuilder == "p");
        $this->assertTrue($stringBuilder->length() === 1);
        $stringBuilder->deleteCharAt(0);
        $this->assertTrue($stringBuilder == "");
        $this->assertTrue($stringBuilder->length() === 0);
    }

    public function testIndexOf() {
        $stringBuilder = new StringBuilder();
        $stringBuilder->append("p");
        $stringBuilder->append("h");
        $stringBuilder->append("p");

        $this->assertTrue($stringBuilder->indexOf("h") === 1);
    }

}