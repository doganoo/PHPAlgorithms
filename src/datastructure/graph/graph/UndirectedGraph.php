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

/**
 * Class Graph
 *
 * @package doganoo\PHPAlgorithms\Graph
 */
class UndirectedGraph extends AbstractGraph {

    /**
     * DirectedGraph constructor.
     *
     * @throws \doganoo\PHPAlgorithms\common\exception\InvalidGraphTypeException
     */
    public function __construct() {
        parent::__construct(self::DIRECTED_GRAPH);
    }


    public function addNode(Node $node): bool {
        return $this->nodeList->add($node);
    }

    /**
     * @param Node $startNode
     * @param Node $endNode
     * @return bool
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    public function addEdge(Node $startNode, Node $endNode): bool {
        $hasStart = $this->hasNode($startNode);
        $hasEnd = $this->hasNode($endNode);
        if (false === $hasStart) {
            //TODO notify caller
            return false;
        }
        if (false === $hasEnd) {
            //TODO notify caller
            return false;
        }
        /** @var Node $startNode */
        $startNode = $this->getNode($startNode);
        /** @var Node $endNode */
        $endNode = $this->getNode($endNode);
        if ($startNode->hasAdjacent($endNode)) {
            //TODO notify caller
            return false;
        }
        $startNode->addAdjacent($endNode);

        $indexOfStartNode = $this->getIndexOf($startNode);
        if (-1 === $indexOfStartNode) {
            Logger::warn("warning. node is not going to be replaced");
            return true;
        }
        $this->nodeList->set($indexOfStartNode, $startNode);
        return true;
    }

    /**
     * This method is required due to PHP native function == and/or ===.
     * The Node class has a ArrayList property which grows over time.
     * If the ArrayList property does not contain the exactly same size/
     * values, == and/or === returns false.
     *
     * TODO implement Comparable interface and remove this helper methods
     *
     * @param Node $node
     * @return bool
     */
    private function hasNode(Node $node): bool {
        /**
         * @var Node $value
         */
        foreach ($this->nodeList as $key => $value) {
            if ($value->getValue() === $node->getValue()) {
                return true;
            }
        }
        return false;
    }

    /**
     * This method is required due to PHP native function == and/or ===.
     * The Node class has a ArrayList property which grows over time.
     * If the ArrayList property does not contain the exactly same size/
     * values, == and/or === returns false.
     *
     * TODO implement Comparable interface and remove this helper methods
     *
     * @param Node $node
     * @return Node|null
     */
    private function getNode(Node $node): ?Node {
        /**
         * @var Node $value
         */
        foreach ($this->nodeList as $key => $value) {
            if ($value->getValue() === $node->getValue()) {
                return $value;
            }
        }
        return null;
    }

    /**
     * This method is required due to PHP native function == and/or ===.
     * The Node class has a ArrayList property which grows over time.
     * If the ArrayList property does not contain the exactly same size/
     * values, == and/or === returns false.
     *
     * TODO implement Comparable interface and remove this helper methods
     *
     * @param Node $node
     * @return int
     */
    private function getIndexOf(Node $node): int {
        /**
         * @var Node $value
         */
        foreach ($this->nodeList as $key => $value) {
            if ($value->getValue() === $node->getValue()) {
                return $key;
            }
        }
        return -1;
    }
}