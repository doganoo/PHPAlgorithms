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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree\AVLTree;

use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinaryTree\BinarySearchNode;

/**
 * Class Node
 * @package doganoo\PHPAlgorithms\Datastructure\Graph\Tree\AVLTree
 */
class Node extends BinarySearchNode {

    /**
     * @param IBinaryNode|null $left
     */
    public function setLeft(?IBinaryNode $left): void {
        if (false === $left instanceof Node) return;
        parent::setLeft($left);
    }

    /**
     * @param IBinaryNode|null $right
     */
    public function setRight(?IBinaryNode $right): void {
        if (false === $right instanceof Node) return;
        parent::setRight($right);
    }

    /**
     * @return int
     */
    public function getBalance(): int {
        $leftHeight  = (null === $this->getLeft()) ? 0 : $this->getLeft()->getHeight();
        $rightHeight = (null === $this->getRight()) ? 0 : $this->getRight()->getHeight();
        return $leftHeight - $rightHeight;
    }

}