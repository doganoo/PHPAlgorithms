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

namespace StackQueue;

use doganoo\PHPAlgorithms\Datastructure\Stackqueue\StackSet;
use PHPUnit\Framework\TestCase;

/**
 * Class StackSetTest
 *
 * @package StackQueue
 */
class StackSetTest extends TestCase {
    /**
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    public function testStackSet() {
        $stackSet = new StackSet(2);
        $stackSet->push("Hallo");
        $stackSet->push("Hallo 2");
        $this->assertTrue($stackSet->stackCount() === 1);
        $stackSet->push("Hallo 3");
        $this->assertTrue($stackSet->stackCount() === 2);
        $element = $stackSet->pop();
        $this->assertTrue($element === "Hallo 3");
        $this->assertTrue($stackSet->stackCount() === 1);
    }

    /**
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    public function testHugeStackSet() {
        $setSize = 1024;
        $factor = 4;
        $stackSet = new StackSet(1024);
        for ($i = 0; $i < $setSize * $factor; $i++) {
            $stackSet->push($i);
        }
        $this->assertTrue($stackSet->stackCount() === $factor);
        for ($i = 0; $i < $setSize + 1; $i++) {
            $stackSet->pop();
        }
        $this->assertTrue($stackSet->stackCount() === 3);
    }
}