<?php
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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Graph;

use doganoo\PHPAlgorithms\Common\Abstracts\AbstractGraph;
use doganoo\PHPUtil\Log\Logger;
use doganoo\PHPUtil\Util\ClassUtil;

/**
 * Class Graph
 *
 * @package doganoo\PHPAlgorithms\Graph
 */
class DirectedGraph extends AbstractGraph {

    /**
     * DirectedGraph constructor.
     *
     * @throws \doganoo\PHPAlgorithms\common\exception\InvalidGraphTypeException
     */
    public function __construct() {
        parent::__construct(self::DIRECTED_GRAPH);
    }

    /**
     * @param Node      $node
     * @param Node|null $parent
     * @throws \ReflectionException
     */
    public function addNode(Node $node, Node $parent = null) {
        /**
         * if there is no parent node defined and the node is not already in the list,
         * simply add it to the list and the job is done.
         */
        if (null === $parent && !$this->linkedList->containsKey($node->getValue())) {
            $this->linkedList->add($node->getValue(), $node);
            return;
        }
        /**
         * if the node already exists in the list, retrieve it and add a further child.
         * if there is no element in the list, add node as a child of parent and add parent
         * to the list
         */
        if ($this->linkedList->containsKey($parent->getValue())) {
            /** @var Node $parentNode */
            $parentNode = $this->linkedList->getNodeByKey($parent->getValue())->getValue();
            $parentNode = \unserialize($parentNode);
            $hasChildParent = $this->hasChildParent($node, $parent);
            if (!$hasChildParent) {
                $parentNode->addChild($node);
                $this->linkedList->remove($parentNode->getValue());
                $this->linkedList->add($parentNode->getValue(), $parentNode);
            }
            return;
        } else {
            $hasChildParent = $this->hasChildParent($node, $parent);
            if (!$hasChildParent) {
                $parent->addChild($node);
                $this->linkedList->add($parent->getValue(), $parent);
            }
            return;
        }
    }

    private function hasChildParent(Node $child, Node $parent) {
        /** @var Node $parentNode */
        $parentNode = $this->linkedList->getNodeByKey($parent->getValue());
        /** @var Node $childNode */
        $childNode = $this->linkedList->getNodeByKey($child->getValue());

        if (null === $parentNode || null === $childNode) {
            return false;
        }

        if ($childNode->hasChild($parentNode)) {
            return true;
        }
        return false;
    }

}