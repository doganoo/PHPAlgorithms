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

namespace doganoo\PHPAlgorithms\Common\Abstracts;


use doganoo\PHPAlgorithms\Algorithm\Traversal\InOrder;
use doganoo\PHPAlgorithms\Algorithm\Traversal\PostOrder;
use doganoo\PHPAlgorithms\Algorithm\Traversal\PreOrder;
use doganoo\PHPAlgorithms\Common\Interfaces\IBinaryNode;
use doganoo\PHPAlgorithms\Common\Interfaces\IComparable;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use JsonSerializable;
use function max;

/**
 * Class AbstractTree
 *
 * @package doganoo\PHPAlgorithms\Common\Abstracts
 */
abstract class AbstractTree implements IComparable, JsonSerializable {
    public const ARRAY_IN_ORDER = 1;
    public const ARRAY_PRE_ORDER = 2;
    public const ARRAY_POST_ORDER = 3;
    /** @var null|IBinaryNode $root */
    private $root = null;

    /**
     * @param IBinaryNode $p
     * @param IBinaryNode $q
     * @return IBinaryNode|null
     */
    public function getCommonAncestor(IBinaryNode $p, IBinaryNode $q): ?IBinaryNode {
        if (!$this->inNode($this->root, $p) || !$this->inNode($this->root, $q)) return null;
        return $this->commonAncestor($this->root, $p, $q);
    }

    /**
     * @param IBinaryNode $haystack
     * @param IBinaryNode $needle
     * @return bool
     */
    private function inNode(?IBinaryNode $haystack, IBinaryNode $needle): bool {
        if (null === $haystack) return false;
        if (Comparator::equals($haystack, $needle)) return true;
        return $this->inNode($haystack->getLeft(), $needle) || $this->inNode($haystack->getRight(), $needle);
    }

    /**
     * @param IBinaryNode|null $root
     * @param IBinaryNode      $p
     * @param IBinaryNode      $q
     * @return IBinaryNode|null
     */
    private function commonAncestor(?IBinaryNode $root, IBinaryNode $p, IBinaryNode $q): ?IBinaryNode {
        if (null === $root || Comparator::equals($root, $p) || Comparator::equals($root, $q)) return $root;

        $pOnLeft = $this->inNode($root->getLeft(), $p);
        $qOnLeft = $this->inNode($root->getLeft(), $q);

        if ($pOnLeft !== $qOnLeft) return $root;

        $childSide = $pOnLeft === true ? $root->getLeft() : $root->getRight();
        return $this->commonAncestor($childSide, $p, $q);
    }

    /**
     * @param IBinaryNode $node
     * @return bool
     */
    public function inTree(IBinaryNode $node): bool {
        return $this->inNode($this->root, $node);
    }

    /**
     * determines whether the BinaryTree instance is a BST or not
     *
     * @return bool
     */
    public function isBST(): bool {
        return $this->_isBST($this->getRoot());
    }

    /**
     * helper method for isBST()
     *
     * @param IBinaryNode|null $root
     * @param int|null         $min
     * @param int|null         $max
     * @return bool
     */
    private function _isBST(?IBinaryNode $root, ?int $min = null, ?int $max = null): bool {
        //if the root is null, the BST condition is met
        if (null === $root) return true;
        /*
         * since the whole left subtree has to be smaller than the root,
         * it is not enough to just check for
         *          left <= current < right
         *
         * the whole left subtree has to be smaller than the root. Therefore,
         * when we branch left, we check that the value is between NULL and
         * root's value. When we branch right, we check the value is between
         * roots'value and NULL.
         */
        if ((null !== $min) && (Comparator::lessThanEqual($root->getValue(), $min))) return false;
        if ((null !== $max) && (Comparator::greaterThanEqual($root->getValue(), $max))) return false;
        /*
         * If we branch left, $max gets updated (to the root's value). If we
         * branch right, $min gets updated (to the roots's value).
         *
         * If any of those comparisions fail, the method breaks immediately and returns
         * false.
         */
        if (!$this->_isBST($root->getLeft(), $min, $root->getValue())) return false;
        if (!$this->_isBST($root->getRight(), $root->getValue(), $max)) return false;
        return true;
    }

    /**
     * @return IBinaryNode|null
     */
    public function getRoot(): ?IBinaryNode {
        return $this->root;
    }

    /**
     * @param IBinaryNode|null $root
     */
    public function setRoot(?IBinaryNode $root) {
        $this->root = $root;
    }

    /**
     * returns the height
     *
     * @return int
     */
    public function height(): int {
        return $this->root->getHeight();
    }

    ///**
    /// TODO code does not work, compared to Cp4, Q10 on pg. 267 CTCI
    ///
    // * returns a boolean whether $tree is a subtree or not
    // *
    // * @param AbstractTree|null $tree
    // * @return bool
    // */
    //public function isSubTree(?AbstractTree $tree): bool {
    //    //if $tree is null, it is a sub tree of $this per definition
    //    if (null === $tree) return true;
    //    //compare $this and $tree
    //    return $this->_isSubTree($this->getRoot(), $tree->getRoot());
    //}
    //
    ///**
    // * helper method - recursive call to all nodes
    // *
    // * @param IBinaryNode|null $haystack
    // * @param IBinaryNode|null $needle
    // * @return bool
    // */
    //private function _isSubTree(?IBinaryNode $haystack, ?IBinaryNode $needle): bool {
    //    /*
    //     * if $haystack is null, $needle can not be a subtree since there is no
    //     * main tree. The method stops and returns false immediately
    //     */
    //    if (null === $haystack) return false;
    //    /*
    //     *
    //     */
    //    else if (Comparator::equals($haystack->getValue(), $needle->getValue()) &&
    //        $this->treeMatches($haystack, $needle)) return true;
    //    return $this->_isSubTree($haystack->getLeft(), $needle)
    //        || $this->_isSubTree($haystack->getRight(), $needle);
    //}
    //
    ///**
    // * traverses through the whole tree and returns false if there is any false comparisions
    // *
    // * @param IBinaryNode|null $haystack
    // * @param IBinaryNode|null $needle
    // * @return bool
    // */
    //private function treeMatches(?IBinaryNode $haystack, ?IBinaryNode $needle): bool {
    //    if (null === $haystack && null === $needle) return true;
    //    else if (null === $haystack || null === $needle) return false;
    //    else if (!Comparator::equals($haystack->getValue(), $needle->getValue())) return false;
    //    else  return $this->treeMatches($haystack->getLeft(), $needle->getLeft()) && $this->treeMatches($haystack->getRight(), $needle->getRight());
    //}

    /**
     * @param int $order
     * @return array
     */
    public function toArray($order = AbstractTree::ARRAY_PRE_ORDER): array {
        $traversal = null;
        if ($order === AbstractTree::ARRAY_IN_ORDER) $traversal = new InOrder($this);
        else if ($order === AbstractTree::ARRAY_PRE_ORDER) $traversal = new PreOrder($this);
        else if ($order === AbstractTree::ARRAY_POST_ORDER) $traversal = new PostOrder($this);
        else $traversal = new PreOrder($this);
        $array = [];
        $traversal->setCallable(function ($value) use (&$array) {
            $array[] = $value;
        });
        $traversal->traverse();
        return $array;
    }

    /**
     * returns the number of nodes in the tree
     *
     * @return int
     */
    public abstract function getSize(): int;

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof AbstractTree) {
            if (Comparator::equals($this->getRoot(), $object->getRoot())) return 0;
            if (Comparator::lessThan($this->getRoot(), $object->getRoot())) return -1;
            if (Comparator::greaterThan($this->getRoot(), $object->getRoot())) return 1;
        }
        return -1;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            "nodes" => $this->root
        ];
    }
}