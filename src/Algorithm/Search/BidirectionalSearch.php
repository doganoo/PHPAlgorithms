<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * @author Eugene Kirillov <eug.krlv@gmail.com>
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

namespace doganoo\PHPAlgorithms\Algorithm\Search;

use doganoo\PHPAlgorithms\Datastructure\Graph\Graph\Node;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayList\ArrayList;

/**
 * TODO implement AbstractGraphSearch
 *
 * Class BidirectionalSearch
 *
 * @package doganoo\PHPAlgorithms\Algorithm\Search
 */
class BidirectionalSearch {

    /**
     * @param Node $start
     * @param Node $end
     * @return bool
     */
    public function hasPath(Node $start, Node $end): bool {
        $startList = $this->performSearch($start);
        $endList = $this->performSearch($end);

        if (null === $startList
            || $startList->length() === 0
            || null === $endList
            || $endList->length() === 0) {
            $startList->retainAll($endList);
            return $startList->length() > 0;
        }
        return false;
    }

    /**
     * @param Node $node
     * @return ArrayList|null
     */
    private function performSearch(Node $node): ?ArrayList {
        $bfs = new BreadthFirstSearch();
        $bfs->setCallable(
            function () {
            }
        );
        $bfs->searchByNode($node);
        return $bfs->getVisitedNodes();
    }

}