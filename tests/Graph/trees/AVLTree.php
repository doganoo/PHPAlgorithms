<?php

use doganoo\PHPAlgorithms\Algorithm\Traversal\PreOrder;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\AVLTree as AVLTreee;
use PHPUnit\Framework\TestCase;

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


class AVLTree extends TestCase {


    public function testTree() {

        $this->markTestSkipped("need to implement - There is one bug remaining");

//        $avlTree = new AVLTreee();
//        $avlTree->insertValue(10);
//        $avlTree->insertValue(20);
//        $avlTree->insertValue(30);
//        $avlTree->insertValue(40);
//        $avlTree->insertValue(50);
//        $avlTree->insertValue(25);

//        $array = [];
//        $preOrder = new PreOrder($avlTree);
//        $preOrder->setCallable(function ($v) use (&$array){
//           $array[] = $v;
//        });
//        $preOrder->traverse();
//
//        print_r($array);
//        $this->assertTrue($array === [30, 20, 10, 25, 40, 50]);

    }

}