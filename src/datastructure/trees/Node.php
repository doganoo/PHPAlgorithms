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

namespace doganoo\PHPAlgorithms\Trees;


class Node
{
    private $left = null;
    private $right = null;
    private $value = PHP_INT_MIN;


    public function insert(int $value)
    {
        if ($this->value == PHP_INT_MIN) {
            $this->value = $value;
            return;
        }

        $node = new Node();
        $node->setValue($value);
        if ($value < $this->value) {
            if ($this->getLeft() == null) {
                $this->setLeft($node);
            } else {
                $this->getLeft()->insert($value);
            }
        } else {
            if ($this->getRight() == null) {
                $this->setRight($node);
            } else {
                $this->getRight()->insert($value);
            }
        }
    }

    public function contains(int $value): bool
    {
        $contains = false;
        if ($value === $this->getValue()) {
            return true;
        }

        if ($value < $this->getValue()) {
            if ($this->getLeft() !== null) {
                $contains = $this->getLeft()->contains($value);
            }
        } else {
            if ($this->getRight() !== null) {
                $contains = $this->getRight()->contains($value);
            }
        }
        return $contains;
    }

    public function printInOrder()
    {
        if ($this->getLeft() !== null) {
            $this->getLeft()->printInOrder();
        }
        echo $this->getValue();
        echo "\n";
        if ($this->getRight() !== null) {
            $this->getRight()->printInOrder();
        }
    }

    /**
     * @return Node
     */
    public function getLeft(): ?Node
    {
        return $this->left;
    }

    /**
     * @param Node $left
     */
    public function setLeft(?Node $left): void
    {
        $this->left = $left;
    }

    /**
     * @return Node
     */
    public function getRight(): ?Node
    {
        return $this->right;
    }

    /**
     * @param Node $right
     */
    public function setRight(?Node $right): void
    {
        $this->right = $right;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @param int $value
     */
    public function setValue(int $value): void
    {
        $this->value = $value;
    }
}