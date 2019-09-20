<?php
declare(strict_types=1);
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

namespace doganoo\PHPAlgorithmsTest\Comparator;

use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Graph\Graph\Node;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;
use PHPUnit\Framework\TestCase;

class ComparatorTest extends TestCase {

    public function testComparator() {
        $node  = new Node(1);
        $node2 = new Node(2);
        $this->assertTrue(Comparator::equals($node, $node2) === false);


        $node  = new Node(1);
        $node2 = new Node(1);
        $this->assertTrue(Comparator::equals($node, $node2) === true);


        $node  = new Node(1);
        $value = "test";
        $this->assertTrue(Comparator::equals($node, $value) === false);

        $node  = "test";
        $value = "test";
        $this->assertTrue(Comparator::equals($node, $value) === true);

        $node  = "1";
        $value = 1;
        $this->assertTrue(Comparator::equals($node, $value) === true);

        $node  = new Node(1);
        $value = new ArrayList();
        $this->assertTrue(Comparator::equals($node, $value) === false);
    }

}