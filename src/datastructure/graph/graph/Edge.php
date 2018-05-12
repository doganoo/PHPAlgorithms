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

namespace doganoo\PHPAlgorithms\datastructure\graph\graph;

/**
 * Class Edge
 *
 * @package doganoo\PHPAlgorithms\datastructure\graph\graph
 */
class Edge {
    /** @var Node|null $startNode */
    private $startNode = null;
    /** @var Node|null $endNode */
    private $endNode = null;

    /**
     * Edge constructor.
     *
     * @param Node $startNode
     * @param Node $endNode
     */
    public function __construct(Node $startNode, Node $endNode) {
        $this->startNode = $startNode;
        $this->endNode = $endNode;
    }

    public function equals(Edge $edge) {
        return $edge->getEndNode() == $this->endNode
            && $edge->getStartNode() == $this->startNode;
    }
    public function equalsInverse(Edge $edge) {
        return $edge->getEndNode() == $this->startNode
            && $edge->getStartNode() == $this->endNode;
    }

    /**
     * @return Node|null
     */
    public function getEndNode(): ?Node {
        return $this->endNode;
    }

    /**
     * @param Node|null $endNode
     */
    public function setEndNode(?Node $endNode): void {
        $this->endNode = $endNode;
    }

    /**
     * @return Node|null
     */
    public function getStartNode(): ?Node {
        return $this->startNode;
    }

    /**
     * @param Node|null $startNode
     */
    public function setStartNode(?Node $startNode): void {
        $this->startNode = $startNode;
    }

}