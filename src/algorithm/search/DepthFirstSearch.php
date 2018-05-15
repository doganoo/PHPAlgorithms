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

namespace doganoo\PHPAlgorithms\algorithm\search;

use doganoo\PHPAlgorithms\Common\Abstracts\AbstractGraph;
use doganoo\PHPAlgorithms\Common\Abstracts\AbstractGraphSearch;
use doganoo\PHPAlgorithms\Datastructure\Graph\Graph\Node;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;

/**
 * Class DepthFirstSearch
 *
 * @package doganoo\PHPAlgorithms\algorithm\search
 */
class DepthFirstSearch extends AbstractGraphSearch {
    /**
     * DepthFirstSearch constructor.
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * @param AbstractGraph $graph
     * @return mixed|void
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    public function search(AbstractGraph $graph) {
        $this->searchByNode($graph->getRoot());
    }

    /**
     * @param Node|null $node
     * @return mixed
     */
    public function searchByNode(?Node $node) {
        if (null === $node) {
            return;
        }
        $this->visit($node);
        $this->visited->add($node);
        /**
         * @var ArrayList $adjacent
         */
        foreach ($node->getAdjacents() as $adjacent) {
            if (!$this->visited->containsValue($adjacent)) {
                $this->searchByNode($adjacent);
            }
        }
    }
}