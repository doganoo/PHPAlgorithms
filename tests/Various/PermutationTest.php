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


namespace Various;


use doganoo\PHPAlgorithms\Algorithm\Various\Permutation;
use PHPUnit\Framework\TestCase;

class PermutationTest extends TestCase {


    public function testStringPermutation() {
        $permutation = new Permutation();
        $permutations = $permutation->stringPermutations("abcd");
        $this->assertTrue(24 === \count($permutations));

        $permutations = $permutation->stringPermutations("abc");
        $this->assertTrue(\in_array("cba", $permutations));
        $this->assertTrue(\in_array("bac", $permutations));
        $this->assertTrue(\in_array("acb", $permutations));
    }

    public function testNumberPermutation() {
        $permutation = new Permutation();
        $permutations = $permutation->numberPermutations(1234);
        $this->assertTrue(24 === \count($permutations));

        $permutations = $permutation->numberPermutations(1234);
        $this->assertTrue(\in_array(4321, $permutations));
    }

}