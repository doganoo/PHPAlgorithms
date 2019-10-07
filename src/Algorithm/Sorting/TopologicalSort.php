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

namespace doganoo\PHPAlgorithms\Algorithm\Sorting;

use doganoo\PHPAlgorithms\Common\Abstracts\AbstractGraph;
use doganoo\PHPAlgorithms\Common\Exception\InvalidGraphTypeException;
use doganoo\PHPAlgorithms\Common\Interfaces\IGraphSortable;
use doganoo\PHPAlgorithms\Datastructure\Graph\Graph\DirectedGraph;
use doganoo\PHPAlgorithms\Datastructure\Graph\Graph\Node;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;
use doganoo\PHPAlgorithms\Datastructure\Stackqueue\Stack;

/**
 * Class TopologicalSort
 *
 * @package doganoo\PHPAlgorithms\Algorithm\Sorting
 */
class TopologicalSort implements IGraphSortable {

    /**
     * @param AbstractGraph $graph
     * @return Stack
     * @throws \doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException
     * @throws InvalidGraphTypeException
     */
    public function sort(AbstractGraph $graph): Stack {
        if (!$graph instanceof DirectedGraph) {
            throw new InvalidGraphTypeException("topological sorting is only valid for directed graphs");
        }
        if ($graph->hasCycle()) {
            throw new InvalidGraphTypeException("the graph has a cycle. Topological sorting is only possible for directed acyclic graphs");
        }
        $allNodes = $graph->getNodes();
        $result   = new Stack();
        $visited  = new ArrayList();

        /*
         * starting with any node, it is first necessary to determine
         * whether the node is already visited. If not, a helper method is
         * called, which has the business logic.
         */
        /** @var Node $node */
        foreach ($allNodes as $node) {
            /*
             * skip node if it is already visited. Notice
             * that $visited and $result are passed by reference
             */
            if ($visited->containsValue($node)) continue;
            $this->_sort($node, $result, $visited);
        }
        return $result;
    }

    /**
     * @param Node      $node
     * @param Stack     $result
     * @param ArrayList $visited
     * @return void
     * @throws InvalidGraphTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException
     */
    private function _sort(Node $node, Stack &$result, ArrayList &$visited): void {
        $visited->add($node);
        /*
         * continue with the adjacent nodes of $node. The method calls itself
         * recursively until there are no nodes (the node is a leaf). Then,
         * the node is added to the stack (which is passed by reference)
         */
        /** @var Node $adjacent */
        foreach ($node->getAdjacents() as $adjacent) {
            //skip if already visited
            if ($visited->containsValue($adjacent)) continue;
            //recursive call with the adjacent node of $node
            $this->_sort($adjacent, $result, $visited);
        }
        //add node to result stack
        $result->push($node);
    }

}