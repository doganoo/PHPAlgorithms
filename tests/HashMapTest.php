<?php

use doganoo\PHPAlgorithms\Maps\HashMap;

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
class HashMapTest extends \PHPUnit\Framework\TestCase {

    public function testAddition() {
        $class = stdClass::class;
        $hashMap = new HashMap();
        $boolean = $hashMap->add(1, $class);
        $this->assertTrue($boolean);
    }

    public function testContains() {
        $class = stdClass::class;
        $hashMap = new HashMap();
        $hashMap->add(1, $class);
        $boolean = $hashMap->containsValue($class);
        $this->assertTrue($boolean);
    }

    public function testGetNodeByValue() {
        $class = stdClass::class;
        $hashMap = new HashMap();
        $hashMap->add(1, $class);
        $node = $hashMap->getNodeByValue($class);
        $this->assertTrue($node !== null);
    }

    public function testRemove() {
        $hashMap = HashMapUtil::getHashMap(500);
        $boolean = $hashMap->remove(320);
        $this->assertTrue($boolean);
    }

    public function testKeyTypes() {
        $hashMap = new HashMap();
        $added = $hashMap->add(new stdClass(), "stdClass");
        $this->assertTrue($added);
    }

    public function testKeySet() {
        $hashMap = HashMapUtil::getHashMap(10);
        $keySet = $hashMap->keySet();
        $this->assertTrue(count($keySet) == 10);
    }

}