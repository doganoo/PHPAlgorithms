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

namespace doganoo\PHPAlgorithms\Algorithm\Search;


use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\Common\Util\Comparator;

/**
 * Class RecursiveSearch
 *
 * @package doganoo\PHPAlgorithms\Trees\Search
 */
class RecursiveSearch {
    /**
     * @param IBinaryNode|null $node
     * @param                  $needle
     * @return bool
     */
    public function search(?IBinaryNode $node, $needle) {
        if (null === $node) {
            return false;
        }
        if (Comparator::equals($node->getValue(), $needle)) {
            return true;
        } else if (Comparator::lessThan($needle, $node->getValue())) {
            return $this->search($node->getLeft(), $needle);
        } else if (Comparator::greaterThan($needle, $node->getValue())) {
            return $this->search($node->getRight(), $needle);
        }
        return false;
    }
}