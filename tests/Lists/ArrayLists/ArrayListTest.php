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

namespace doganoo\PHPAlgorithmsTest\Lists\ArrayLists;

use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;
use PHPUnit\Framework\TestCase;
use stdClass;

class ArrayListTest extends TestCase {
    public function testAdd() {
        $arrayList = new ArrayList();
        $added = $arrayList->add("value");
        $this->assertTrue($added === true);
        $value = $arrayList->get(0);
        $this->assertTrue($value === "value");
        $arrayList->add("newxtvalue");
        $arrayList->addToIndex(1, "test");
        $value = $arrayList->get(1);
        $this->assertTrue($value === "test");
        $this->assertTrue($arrayList->size() === 3);

        $added = $arrayList->addAllArray([1, 2, 3, 4, 5, 6]);
        $this->assertTrue($added === true);
        $this->assertTrue($arrayList->size() === 9);

        $arrayList = new ArrayList();
        $arrayList->add("one");
        $arrayList->add("two");
        $arrayList->add("three");
        $arrayList->add("four");


        $arrayListTwo = new ArrayList();
        $arrayListTwo->add("five");
        $arrayListTwo->add("six");
        $arrayListTwo->add("seven");
        $arrayListTwo->add("eight");

        $arrayList->addAll($arrayListTwo);

        $this->assertTrue($arrayList->length() === 8);
    }

    public function testContainsKey() {
        $arrayList = new ArrayList();
        $arrayList->add("five");
        $arrayList->add("six");
        $arrayList->add("seven");
        $arrayList->add("eight");

        $this->assertTrue(true === $arrayList->containsKey(0));
        $this->assertTrue(true === $arrayList->containsKey(1));
        $this->assertTrue(true === $arrayList->containsKey(2));
        $this->assertTrue(true === $arrayList->containsKey(3));
        $this->assertTrue(false === $arrayList->containsKey(4));
        $this->assertTrue(false === $arrayList->containsKey(50));
        $this->assertTrue(false === $arrayList->containsKey(150));

    }

    public function testClear() {
        $arrayList = new ArrayList();
        $arrayList->add("one");
        $arrayList->add("two");
        $arrayList->add("three");
        $arrayList->add("four");
        $this->assertTrue($arrayList->isEmpty() !== true);
        $arrayList->clear();
        $this->assertTrue($arrayList->size() === 0);
        $this->assertTrue($arrayList->isEmpty() === true);
    }

    public function testRemoveAll() {
        $arrayList = new ArrayList();
        $arrayList->add("one");
        $arrayList->add("two");
        $arrayList->add("three");
        $arrayList->add("four");
        $removed = $arrayList->removeAll($arrayList);
        $this->assertTrue($arrayList->isEmpty() === true);
        $this->assertTrue($removed === true);
    }

    public function testRemoveByValue() {
        $arrayList = new ArrayList();
        $arrayList->add("one");
        $arrayList->add("two");
        $arrayList->add("three");
        $arrayList->add("four");

        $removed = $arrayList->removeByValue("one");
        $this->assertTrue($arrayList->containsValue("two"));
        $this->assertTrue($arrayList->length() === 3);
        $this->assertTrue($removed);
    }

    public function testIndexOf() {
        $arrayList = new ArrayList();
        $arrayList->add("one");
        $arrayList->add("two");
        $arrayList->add("three");
        $arrayList->add("four");
        $this->assertTrue($arrayList->indexOf("three") === 2);
    }

    public function testRemove() {
        $arrayList = new ArrayList();
        $arrayList->add("one");
        $arrayList->add("two");
        $arrayList->add("three");
        $arrayList->add("four");
        $removed = $arrayList->remove(2);
        $this->assertTrue($removed);
        $this->assertTrue($arrayList->containsValue("three") === false);
    }

    public function testRemoveRange() {
        $arrayList = new ArrayList();
        $arrayList->add("one");
        $arrayList->add("two");
        $arrayList->add("three");
        $arrayList->add("four");
        $removed = $arrayList->removeRange(1, 2);
        $this->assertTrue($removed);
        $this->assertTrue(
            $arrayList->containsValue("one") === true
            && $arrayList->containsValue("two") === false
            && $arrayList->containsValue("three") === false
            && $arrayList->containsValue("four") === true
            && $arrayList->length() === 2
        );
    }

    public function testSet() {
        $arrayList = new ArrayList();
        $arrayList->add("one");
        $arrayList->add("two");
        $arrayList->add("three");
        $arrayList->add("four");

        $set = $arrayList->set(3, "test");
        $this->assertTrue($set === true);
    }

    public function testSubList() {
        $arrayList = new ArrayList();
        $arrayList->add("one");
        $arrayList->add("two");
        $arrayList->add("three");
        $arrayList->add("four");

        $subList = $arrayList->subList(1, 3);
        $this->assertTrue($subList->size() === 2);
        $this->assertTrue($subList->get(0) === "two");
        $this->assertTrue($subList->get(1) === "three");
        $this->assertTrue($arrayList->size() === 4);
    }

    public function testIterator() {
        $arrayList = new ArrayList();
        $arrayList->add("one");
        $arrayList->add("two");
        $arrayList->add("three");
        $i = 0;
        foreach ($arrayList as $key => $value) {
            $i++;
        }
        $this->assertTrue($i === $arrayList->length());
    }

    public function testSerialize() {
        $arrayList = new ArrayList();
        $x = new class {
            public $id;
        };
        $x->id = 1;
        $arrayList->add($x);
        $x->id = 2;
        $arrayList->add($x);
        $x->id = 3;
        $arrayList->add($x);
        $x->id = 4;
        $arrayList->add($x);
        $x->id = 5;
        $arrayList->add($x);
        $x->id = 6;
        $arrayList->add($x);
        $x->id = 7;
        $arrayList->add($x);
        $x->id = 8;
        $arrayList->add($x);
        $x->id = 9;
        $arrayList->add($x);
        $x->id = 10;
        $arrayList->add($x);
        $x->id = 11;
        $arrayList->add($x);
        $x->id = 12;
        $arrayList->add($x);
        $x->id = 13;
        $arrayList->add($x);
        $x->id = 14;
        $arrayList->add($x);
        $x->id = 15;
        $arrayList->add($x);
        $x->id = 16;
        $arrayList->add($x);
        $x->id = 17;
        $arrayList->add($x);

        $json = json_encode($arrayList);
        $this->assertTrue(false !== is_string($json));

        $list = json_decode($json);

        $this->assertTrue(null !== $list && $list instanceof stdClass);
    }

    public function testSort() {
        $arrayList = new ArrayList();
        $arrayList->add(3);
        $arrayList->add(2);
        $arrayList->add(5);
        $arrayList->add(1);
        $arrayList->add(4);
        $arrayList->add(6);

        $arrayList->sort();

        $this->assertTrue(1 === $arrayList->get(0));
        $this->assertTrue(2 === $arrayList->get(1));
        $this->assertTrue(3 === $arrayList->get(2));
        $this->assertTrue(4 === $arrayList->get(3));
        $this->assertTrue(5 === $arrayList->get(4));
        $this->assertTrue(6 === $arrayList->get(5));
    }

}