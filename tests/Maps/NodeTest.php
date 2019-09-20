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

namespace doganoo\PHPAlgorithmsTest\Maps;

use doganoo\PHPAlgorithms\Datastructure\Lists\Node;
use PHPUnit\Framework\TestCase;

/**
 * Class NodeTest PHPUnit test class
 */
class NodeTest extends TestCase {

    /**
     * tests node assignments
     */
    public function testNodeReference() {
        $a = new Node();
        $a->setKey(1);
        $a->setValue("1");

        $b = new Node();
        $b->setKey(2);
        $b->setValue("2");

        $c = new Node();
        $c->setKey(3);
        $c->setValue("3");

        $b->setNext($c);
        $a->setNext($b);

        $d = $a;
        $d = $d->getNext();
        $this->assertTrue($d->size() == 2);
        $this->assertTrue($a->size() == 3);
    }

}
