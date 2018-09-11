<?php
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

use doganoo\PHPAlgorithms\Algorithm\Traversal\InOrder;
use doganoo\PHPAlgorithms\Algorithm\Traversal\PostOrder;
use doganoo\PHPAlgorithms\Algorithm\Traversal\PreOrder;
use doganoo\PHPAlgorithms\Common\Interfaces\IComparable;
use doganoo\PHPAlgorithms\Datastructure\Graph\Tree\BinarySearchTree;

/**
 * Class BinaryTreeTest
 */
class BinarySearchTreeTest extends \PHPUnit\Framework\TestCase {

    /**
     * tests addition and height
     */
    public function testAdd() {
        /** @var BinarySearchTree $bst */
        $bst = \TreeUtil::getBinarySearchTree();
        $node = $bst->search(1);
        $this->assertTrue($node !== null);
        $this->assertTrue($bst->height() === 3);
    }

    public function testMinimumHeight() {
        $tree = BinarySearchTree::createFromArrayWithMinimumHeight([25, 50, 75, 100, 125, 150, 175]);
        $this->assertTrue($tree->height() === 3);
        $tree = BinarySearchTree::createFromArrayWithMinimumHeight(null);
        $this->assertTrue($tree === null);
        $tree = BinarySearchTree::createFromArray([25, 50, 75, 100, 125, 150, 175]);
        $this->assertTrue($tree->height() === 7);
        $tree = BinarySearchTree::createFromArrayWithMinimumHeight([175, 150, 125, 100, 75, 50, 25]);
        $this->assertTrue($tree->height() === 3);

    }

    /**
     * tests in order Traversal
     */
    public function testInOrder() {
        $bst = \TreeUtil::getBinarySearchTree();
        $array = [];
        $traversal = new InOrder($bst);
        $traversal->setCallable(function ($value) use (&$array) {
            $array[] = $value;
        });
        $traversal->traverse();
        $this->assertTrue($array === [1, 2, 5, 6]);
    }

    /**
     * tests pre order Traversal
     */
    public function testPreOrder() {
        $bst = \TreeUtil::getBinarySearchTree();
        $array = [];
        $traversal = new PreOrder($bst);
        $traversal->setCallable(function ($value) use (&$array) {
            $array[] = $value;
        });
        $traversal->traverse();
        $this->assertTrue($array === [5, 2, 1, 6]);
    }

    /**
     * tests post order Traversal
     */
    public function testPostOrder() {
        $bst = \TreeUtil::getBinarySearchTree();
        $array = [];
        $traversal = new PostOrder($bst);
        $traversal->setCallable(function ($value) use (&$array) {
            $array[] = $value;
        });
        $traversal->traverse();
        $this->assertTrue($array === [1, 2, 6, 5]);
    }

    public function testWithObjects() {
        $tree = new BinarySearchTree();
        $upper = 10;
        for ($i = 0; $i < $upper; $i++) {
            $x = new TestNode($i);
            $tree->insertValue($x);
        }
        $this->assertTrue($tree->height() === $upper);
        $node = $tree->search(new TestNode(4));
        $this->assertTrue($node !== null);
        $node = $tree->search(new TestNode($upper + 5));
        $this->assertTrue($node === null);

    }
}

class TestNode implements IComparable {
    private $id = 0;

    public function __construct($id) {
        $this->id = $id;
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof TestNode) {
            if ($this->getId() === $object->getId()) return 0;
            if ($this->getId() < $object->getId()) return -1;
            if ($this->getId() > $object->getId()) return 1;
        }
        return -1;
    }

    public function getId(): int {
        return $this->id;
    }
}

;