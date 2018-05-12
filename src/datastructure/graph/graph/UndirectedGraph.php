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
        parent::__construct(self::UNDIRECTED_GRAPH);
    }

    /**
     * @param Node $node
     * @return bool
     * @throws \ReflectionException
     * @throws \doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException
     */
    public function addNode(Node $node): bool {
        return $this->nodeSet->add($node);
    }

    /**
     * @param Node $startNode
     * @param Node $endNode
     * @return bool
     */
    public function addEdge(Node $startNode, Node $endNode): bool {
        $hasStart = $this->nodeSet->contains($startNode);
        $hasEnd = $this->nodeSet->contains($endNode);

        if (false === $hasStart) {
            //TODO notify caller
            return false;
        }
        if (false === $hasEnd) {
            //TODO notify caller
            return false;
        }
        $edge = new Edge($startNode, $endNode);

        /**
         * @var      $key
         * @var Edge $value
         */
        foreach ($this->edgeList as $key => $value) {
            if ($edge->equals($value)) {
                //TODO notify caller
                return false;
            }
        }
        $this->edgeList->add($edge);
        return true;

    }
}