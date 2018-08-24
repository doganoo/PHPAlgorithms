<?php
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


use doganoo\PHPAlgorithms\Common\Exception\InvalidGraphTypeException;
use doganoo\PHPAlgorithms\Datastructure\Graph\Graph\Node;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;

/**
 * Class AbstractGraph
 *
 * @package doganoo\PHPAlgorithms\common\Abstracts
 */
abstract class AbstractGraph {
    public const DIRECTED_GRAPH = 1;
    public const UNDIRECTED_GRAPH = 2;
    protected $nodeList = null;
    private $type = 0;

    /**
     * AbstractGraph constructor.
     *
     * @param int $type
     * @throws InvalidGraphTypeException
     */
    protected function __construct($type = self::DIRECTED_GRAPH) {
        $this->nodeList = new ArrayList();
        if ($type === self::DIRECTED_GRAPH || $type === self::UNDIRECTED_GRAPH) {
            $this->type = $type;
        } else {
            throw new InvalidGraphTypeException();
        }
    }

    /**
     * @return Node|null
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    public function getRoot(): ?Node {
        return ($this->nodeList === null ||
            $this->nodeList->size() === 0)
            ? null : $this->nodeList->get(0);
    }

    /**
     * @param $value
     * @return bool
     */
    public function createNode($value): bool {
        $node = new Node($value);
        return $this->addNode($node);
    }

    /**
     * @param Node $node
     * @return bool
     */
    public function addNode(Node $node): bool {
        return $this->nodeList->add($node);
    }

    /**
     * @param Node $startNode
     * @param Node $endNode
     * @return bool
     */
    public abstract function addEdge(Node $startNode, Node $endNode): bool;

    /**
     * @return ArrayList|null
     */
    public function getNodes(): ?ArrayList {
        return $this->nodeList;
    }
}