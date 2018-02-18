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

namespace doganoo\PHPAlgorithms\Trees\Search;


use doganoo\PHPAlgorithms\Trees\Node;

class RecursiveSearch
{
    public function search(?Node $node, int $needle)
    {
        if ($node == null) {
            return false;
        }
        if ($node->getValue() == $needle) {
            return true;
        } else if ($needle < $node->getValue()) {
            return $this->search($node->getLeft(), $needle);
        } else
            if ($needle > $node->getValue()) {
                return $this->search($node->getRight(), $needle);
            }
    }

    public function searchArray(array $array, $needle, $left, $right)
    {
        if ($left > $right) {
            return false;
        }

        $middle = $left + (($left + $right) / 2);
        if ($needle == $array[$middle]) {
            return true;
        } else if ($needle < $array[$middle]) {
            return $this->searchArray($array, $needle, $left, $middle - 1);
        } else {
            return $this->searchArray($array, $needle, $middle + 1, $right);
        }
    }

    public function searchArrayIterative(array $array, int $needle)
    {
        $left = 0;
        $right = count($array);

        while ($left < $right) {
            $middle = $left + (($left + $right) / 2);
            if ($needle == $array[$middle]) {
                return true;
            } else if ($needle < $array[$middle]) {
                $right = $middle - 1;
            } else {
                $left = $middle + 1;
            }
        }
        return false;
    }

}