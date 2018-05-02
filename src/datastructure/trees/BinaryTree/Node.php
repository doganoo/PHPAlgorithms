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

namespace doganoo\PHPAlgorithms\datastructure\trees\BinaryTree;

/**
 * Class Node
 *
 * @package doganoo\PHPAlgorithms\datastructure\trees\BinaryTree
 */
class Node {
    private $left = null;
    private $right = null;
    private $value = PHP_INT_MIN;

    /**
     * Node constructor.
     *
     * @param $value
     */
    public function __construct($value) {
        $this->value = $value;
    }

    /**
     * @return null
     */
    public function getLeft() {
        return $this->left;
    }

    /**
     * @param null $left
     */
    public function setLeft($left): void {
        $this->left = $left;
    }

    /**
     * @return null
     */
    public function getRight() {
        return $this->right;
    }

    /**
     * @param null $right
     */
    public function setRight($right): void {
        $this->right = $right;
    }

    /**
     * @return int
     */
    public function getValue(): int {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void {
        $this->value = $value;
    }
}