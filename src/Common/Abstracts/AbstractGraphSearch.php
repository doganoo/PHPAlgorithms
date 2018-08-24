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

namespace doganoo\PHPAlgorithms\Common\Abstracts;


use doganoo\PHPAlgorithms\Datastructure\Graph\Graph\Node;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;

/**
 * Class AbstractTraverse
 *
 * @package doganoo\PHPAlgorithms\common\Abstracts
 */
abstract class AbstractGraphSearch {
    /** @var $callable callable|null */
    protected $callable = null;
    /** @var ArrayList|null $visited */
    protected $visited = null;

    public function __construct() {
        $this->visited = new ArrayList();
        $this->callable = function (Node $value) {
            echo $value->getValue();
            echo "\n";
        };
    }

    /**
     * @param AbstractGraph $graph
     * @return mixed
     */
    public abstract function search(AbstractGraph $graph);

    /**
     * @param $value
     */
    public function visit(Node $value) {
        $callable = $this->callable;
        if (null === $this->callable
            && !\is_callable($this->callable)) {
            $callable = function (Node $otherValue) {
                echo $otherValue->getValue();
                echo "\n";
            };
        }
        $callable($value);
    }

    public function getVisitedNodes(): ?ArrayList {
        return $this->visited;
    }

    /**
     * @param callable $callable
     */
    public function setCallable(callable $callable) {
        $this->callable = $callable;
    }

    /**
     * @param Node|null $node
     * @return mixed
     */
    public abstract function searchByNode(?Node $node);

}