<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2020 Dogan Ucar, <dogan@dogan-ucar.de>
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

namespace doganoo\PHPAlgorithms\Algorithm\Traversal;

use doganoo\PHPAlgorithms\Common\Abstracts\AbstractTraverse;
use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinarySearchTree;

/**
 * Class LevelOrder
 * @package doganoo\PHPAlgorithms\Algorithm\Traversal
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 */
class LevelOrder extends AbstractTraverse {

    /** @var BinarySearchTree $binarySearchTree */
    private $binarySearchTree;
    /** @var array $levels */
    private $levels;

    /**
     * LevelOrder constructor.
     * @param BinarySearchTree $binarySearchTree
     */
    public function __construct(BinarySearchTree $binarySearchTree) {
        $this->binarySearchTree = $binarySearchTree;
        $this->levels           = [];

        $this->setCallable(
            function (array $values) {
                var_dump(json_encode($values));
            });
    }

    /**
     *Traverses the Binary Search Tree in Level Order
     */
    public function traverse(): void {
        $level  = 0;
        $result = [];
        $this->helper(
            $this->binarySearchTree->getRoot()
            , $result
            , $level
        );


        /**
         * @var int           $level
         * @var IBinaryNode[] $values
         */
        foreach ($result as $level => $values) {
            $this->visit($values);
        }

    }

    /**
     * Helper function to traverse the BST
     *
     * @param IBinaryNode|null $node
     * @param array            $result
     * @param int              $level
     */
    private function helper(?IBinaryNode $node, array &$result, int $level): void {
        if (null === $node) return;

        $levelArray     = $result[$level] ?? [];
        $levelArray[]   = $node;
        $result[$level] = $levelArray;

        if (null !== $node->getLeft()) {
            $this->helper($node->getLeft(), $result, $level + 1);
        }

        if (null !== $node->getRight()) {
            $this->helper($node->getRight(), $result, $level + 1);
        }
    }

}