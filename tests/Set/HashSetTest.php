<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * @author Eugene Kirillov <eug.krlv@gmail.com>
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

namespace doganoo\PHPAlgorithmsTest\Set;

use doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException;
use doganoo\PHPAlgorithms\Common\Exception\UnsupportedKeyTypeException;
use doganoo\PHPAlgorithms\Datastructure\Set\HashSet;
use PHPUnit\Framework\TestCase;

/**
 * Class HashSetTest PHPUnit test class
 */
class HashSetTest extends TestCase {

    /**
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    public function testAdd() {
        $hashSet = new HashSet();
        $hashSet->add("test");
        $this->assertTrue($hashSet->size() === 1);

        $hashSet->addAll(["one", "two", "three", "four"]);
        $this->assertTrue($hashSet->size() === 5);
        $added = $hashSet->add("one");
        $this->assertTrue($added === false);
        $this->assertTrue($hashSet->size() === 5);
    }

    /**
     * @throws UnsupportedKeyTypeException
     * @throws InvalidKeyTypeException
     */
    public function testContains() {
        $hashSet = new HashSet();
        $hashSet->add("test");

        $this->assertTrue($hashSet->size() === 1);
        $this->assertTrue($hashSet->contains("test"));

        $hashSet->addAll(["one", "two", "three", "four"]);

        $contains = $hashSet->containsAll([
            "one"
            , "two"
            , "three"
            , "four"
            , "five"
            , "test",
        ]);
        $this->assertTrue($contains === false);
    }

    /**
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    public function testClear() {
        $hashSet = new HashSet();
        $hashSet->addAll(["one", "two", "three", "four"]);
        $this->assertTrue($hashSet->size() === 4);
        $hashSet->clear();
        $this->assertTrue($hashSet->size() === 0);
        $this->assertTrue($hashSet->isEmpty());
    }

    /**
     * @throws UnsupportedKeyTypeException
     * @throws InvalidKeyTypeException
     */
    public function testRemove() {
        $hashSet = new HashSet();
        $hashSet->addAll(["one", "two", "three", "four"]);
        $this->assertTrue($hashSet->contains("one") === true);
        $hashSet->remove("one");
        $this->assertTrue($hashSet->contains("one") === false);
    }

}