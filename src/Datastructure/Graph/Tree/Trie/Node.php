<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar
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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree\Trie;

use doganoo\PHPAlgorithms\Common\Interfaces\INode;


/**
 * Class Node
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Trie
 */
class Node implements INode {

    private       $value;
    private array $children = [];

    /**
     * @param int $position
     * @return bool
     */
    public function hasChild(int $position): bool {
        return null !== $this->getChildNode($position);
    }

    /**
     * @param int $position
     * @return Node|null
     */
    public function getChildNode(int $position): ?Node {
        if (isset($this->children[$position])) {
            return $this->children[$position];
        }
        return null;
    }

    /**
     * @param int $position
     */
    public function createChildNode(int $position): void {
        $node = new Node();
        $node->setValue($position);
        $this->children[$position] = $node;
    }

    /**
     * creates an node that indicates the end of the word
     */
    public function createEndOfWordNode(): void {
        $this->children[] = new EndOfWordNode();
    }

    /**
     * indicates whether it is the end of the node
     * @return bool
     */
    public function isEndOfWordNode(): bool {
        return $this->children[0] instanceof EndOfWordNode;
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof Node) {
            if ($this->getValue() === $object->getValue()) return 0;
            if ($this->getValue() < $object->getValue()) return -1;
            if ($this->getValue() > $object->getValue()) return 1;
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
     * @param mixed $value
     */
    public function setValue($value): void {
        $this->value = $value;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return array data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize(): array {
        return [
            "value"      => $this->getValue()
            , "children" => $this->children,
        ];
    }

}