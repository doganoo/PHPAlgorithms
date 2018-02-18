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

namespace doganoo\PHPAlgorithms\LinkedLists;


class Node
{
    private $value = 0;
    private $key;
    private $next = null;
    private $previous = null;

    public function getKey(): int
    {
        return $this->key;
    }

    public function setKey(int $key)
    {
        $this->key = $key;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function setValue(string $value)
    {
        $this->value = $value;
    }

    public function setNext(?Node $node)
    {
        $this->next = $node;
    }

    public function getNext(): ?Node
    {
        return $this->next;
    }

    public function setPrevious(Node $node)
    {
        $this->previous = $node;
    }

    public function getPrevious(): ?Node
    {
        return $this->previous;
    }

    public function __toString()
    {
        return $this->prepareString();
    }

    private function prepareString()
    {
        $node = $this->next;
        $string = $this->value . ", ";

        while ($node !== null) {
            $string .= $node->getValue() . ", ";
            $node = $node->getNext();
        }

        return $string;
    }

    public function size()
    {
        $node = $this->next;
        $size = 0;

        while ($node !== null) {
            $size++;
            $node = $node->getNext();
        }
        return $size;
    }
}