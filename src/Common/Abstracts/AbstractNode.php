<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace doganoo\PHPAlgorithms\Common\Abstracts;

use doganoo\PHPAlgorithms\Common\Interfaces\IComparable;
use doganoo\PHPAlgorithms\Common\Interfaces\INode;
use doganoo\PHPAlgorithms\Common\Util\Comparator;

/**
 * Class AbstractNode
 * @package doganoo\PHPAlgorithms\Common\Abstracts
 */
abstract class AbstractNode implements INode {

    /** @var null|mixed $value */
    private $value = null;

    /**
     * AbstractNode constructor.
     * @param null $value
     */
    public function __construct($value = null) {
        $this->setValue($value);
    }

    /**
     * @param $value
     */
    public function setValue($value): void {
        $this->value = $value;
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
     * @param ?AbstractNode $node
     * @return int
     */
    private function height(?AbstractNode $node): int {
        if (null === $node) {
            return 0;
        }

        return 1 + max($this->height($node->getLeft()), $this->height($node->getRight()));
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof AbstractNode) {
            if (Comparator::equals($this->getValue(), $object->getValue())) return IComparable::EQUAL;
            if (Comparator::lessThan($this->getValue(), $object->getValue())) return IComparable::IS_LESS;
            if (Comparator::greaterThan($this->getValue(), $object->getValue())) return IComparable::IS_GREATER;
        }
        return IComparable::IS_LESS;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link  https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return array data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize(): array {
        return [
            "value"    => $this->getValue()
            , "height" => $this->getHeight()
        ];
    }

}