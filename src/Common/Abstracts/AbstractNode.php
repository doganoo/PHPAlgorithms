<?php


namespace doganoo\PHPAlgorithms\Common\Abstracts;


use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\Common\Interfaces\INode;
use doganoo\PHPAlgorithms\Common\Util\Comparator;

abstract class AbstractNode implements INode {

    private $value = null;

    public function __construct($value = null) {
        $this->setValue($value);
    }

    public function setValue($value):void {
        $this->value = $value;
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof AbstractNode) {
            if (Comparator::equals($this->getValue(), $object->getValue())) return 0;
            if (Comparator::lessThan($this->getValue(), $object->getValue())) return -1;
            if (Comparator::greaterThan($this->getValue(), $object->getValue())) return 1;
        }
        return -1;
    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * returns the height
     *
     * @return int
     */
    public function getHeight(): int {
        return $this->height($this);
    }

    /**
     * helper method
     *
     * @param IBinaryNode|null $node
     * @return int
     */
    private function height(?AbstractNode $node): int {
        if (null === $node) {
            return 0;
        }
        return 1 + max(
                $this->height($node->getLeft())
                , $this->height($node->getRight())
            );
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            "value" => $this->getValue()
            , "height" => $this->getHeight()
        ];
    }
}