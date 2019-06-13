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

namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree\RedBlackTree;

use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinaryTree\BinarySearchNode;

/**
 * Class Node
 * @package doganoo\PHPAlgorithms\Datastructure\Graph\Tree\RedBlackTree
 */
class Node extends BinarySearchNode {
    public const BLACK = 1;
    public const RED = 2;

    private $color = Node::BLACK;

    private $parent = null;

    /**
     * @return int
     */
    public function getColor(): int {
        return $this->color;
    }

    public function getColorName():string{
        if (Node::BLACK === $this->getColor()) return "BLACK";
        return "RED";
    }

    /**
     * @param int $color
     */
    public function setColor(int $color): void {
        $this->color = $color;
    }

    public function setParent(?Node $parent):void {
        $this->parent = $parent;
    }

    public function getParent():?Node{
        return $this->parent;
    }

    public function getSibling():?IBinaryNode{

        if (null === $this->getParent()) return null;

        if (Comparator::equals($this, $this->getParent()->getLeft())) return $this->getParent()->getRight();
        if (Comparator::equals($this, $this->getParent()->getRight())) return $this->getParent()->getLeft();

        return null;
    }


    public function getParentsColor():int{
        if (null === $this->getParent()) return Node::BLACK;
        return $this->getParent()->getColor();
    }

    public function getParentsColorName():string{
        if (Node::BLACK === $this->getParentsColor()) return "BLACK";
        return "RED";
    }

}