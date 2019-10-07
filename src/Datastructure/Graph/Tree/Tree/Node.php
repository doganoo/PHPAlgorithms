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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree\Tree;

use doganoo\PHPAlgorithms\Common\Interfaces\INode;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;

/**
 * Class Node
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Graph\Tree\Tree
 */
class Node implements INode {
    /**
     * @var null
     */
    private $value = null;
    /**
     * @var ArrayList|null
     */
    private $children = null;

    /**
     * Node constructor.
     *
     * @param $value
     */
    public function __construct($value) {
        $this->value = $value;
        $this->children = new ArrayList();
    }

    /**
     * @param      $child
     * @param null $parent
     * @return bool
     */
    public function addChild($child, $parent = null): bool {
        $newNode = new Node($child);
        if ($this->getChildren()->containsValue($newNode)) {
            return false;
        }
        if (null === $parent || $parent === $this->value) {
            $this->children->add($newNode);
            return true;
        } else {
            $node = $this->findChild($parent, $this->getChildren());
            if (null !== $node) {
                $node->addChild($child);
                return true;
            }
        }
        return false;
    }

    /**
     * @return ArrayList|null
     */
    public function getChildren(): ?ArrayList {
        return $this->children;
    }

    /**
     * @param                $value
     * @param ArrayList|null $children
     * @return Node|null
     */
    public function findChild($value, ArrayList $children = null) {
        if (null === $children) {
            $children = $this->children;
        }
        /** @var Node $child */
        foreach ($children as $child) {
            if (Comparator::equals($child->getValue(), $value)) {
                return $child;
            }
            if (null !== $child->getChildren()) {
                $node = $this->findChild($value, $child->getChildren());
                if (null !== $node) {
                    return $node;
                }
            }
        }
        return null;
    }

    /**
     * @return null
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param $value
     */
    public function setValue($value): void {
        $this->value = $value;
    }

    /**
     * @param $value
     * @return Node|null
     */
    public function getChild($value) {
        return $this->findChild($value);
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
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            "value" => $this->value
            , "children" => $this->children,
        ];
    }
}
