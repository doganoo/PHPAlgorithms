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

namespace doganoo\PHPAlgorithmsTest\Lists\ArrayList;

use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayList\StringBuilder;
use PHPUnit\Framework\TestCase;

class StringBuilderTest extends TestCase {

    public function testConstructor() {
        $nullStringBuilder = new StringBuilder();
        $this->assertTrue($nullStringBuilder->capacity() === 0);
        $this->assertTrue($nullStringBuilder == "");

        $stringBuilder = new StringBuilder("phpalgorithms");
        $this->assertTrue($stringBuilder->capacity() === 13);
        $this->assertTrue($stringBuilder == "phpalgorithms");

        $intStringBuilder = new StringBuilder(10);
        $this->assertTrue($intStringBuilder->capacity() === 10);
        $this->assertTrue($intStringBuilder == "");
    }

    public function testAppend() {
        $stringBuilder = new StringBuilder();
        $stringBuilder->append("p");
        $stringBuilder->append("h");
        $stringBuilder->append("p");
        $this->assertTrue($stringBuilder->length() === 3);
        $this->assertTrue($stringBuilder == "php");
        $this->assertTrue($stringBuilder->charAt(1) === "h");

        $stringBuilder = new StringBuilder();
        $stringBuilder->append("p");
        $stringBuilder->append("h");
        $stringBuilder->append("p");
        $stringBuilder->insert(1, "tes");
        $this->assertTrue($stringBuilder->capacity() === 4);
        $this->assertTrue($stringBuilder->charAt(1) === "t");
    }

    public function testReverse() {
        $stringBuilder = new StringBuilder();
        $stringBuilder->append("phpalgorithms");
        $stringBuilder = $stringBuilder->reverse();
        $this->assertTrue($stringBuilder == "smhtiroglaphp");
    }

    public function testDelete() {
        $stringBuilder = new StringBuilder();
        $stringBuilder->append("p");
        $stringBuilder->append("h");
        $stringBuilder->append("p");
        $stringBuilder->delete(0, 1);
        $this->assertTrue($stringBuilder == "p");
        $this->assertTrue($stringBuilder->length() === 1);
        $stringBuilder->deleteCharAt(0);
        $this->assertTrue($stringBuilder == "");
        $this->assertTrue($stringBuilder->length() === 0);
    }

    public function testIndexOf() {
        $stringBuilder = new StringBuilder();
        $stringBuilder->append("p");
        $stringBuilder->append("h");
        $stringBuilder->append("p");

        $this->assertTrue($stringBuilder->indexOf("h") === 1);
    }

}