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


namespace doganoo\PHPAlgorithms\Datastructure\Graph\Tree\Trie;

use doganoo\PHPAlgorithms\Common\Interfaces\IComparable;
use doganoo\PHPAlgorithms\Common\Util\Comparator;

/**
 * Class Trie
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Trie
 */
class Trie implements IComparable, \JsonSerializable {
    /**
     * @var RootNode
     */
    private $root;

    /**
     * Trie constructor.
     */
    public function __construct() {
        $this->root = new RootNode();
    }

    /**
     * inserts a new string as a node chain (creates the trie)
     *
     * @param string $string
     */
    public function insert(string $string) {
        $node = $this->root;
        for ($i = 0; $i < \strlen($string); $i++) {
            $position = \ord($string[$i]) - \ord("a");
            if (null === $node->getChildNode($position)) {
                $node->createChildNode($position);
            }
            $node = $node->getChildNode($position);
        }
        $node->createEndOfWordNode();
    }

    /**
     * searches for an string in the trie. $isPrefix indicates whether
     * the method should search for the entire word.
     *
     * @param string $key
     * @param bool   $isPrefix
     * @return bool
     */
    public function search(string $key, bool $isPrefix = false): bool {
        $length = \strlen($key);
        $node = $this->root;

        for ($i = 0; $i < $length; $i++) {
            $index = \ord($key[$i]) - \ord('a');
            if (null === $node->getChildNode($index)) {
                return false;
            }
            $node = $node->getChildNode($index);
        }
        if ($isPrefix) {
            return null !== $node;
        } else {
            return (null !== $node && $node->isEndOfNode());
        }
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof Trie) {
            if (Comparator::equals($this->root, $object->root)) return 0;
            if (Comparator::lessThan($this->root, $object->root)) return -1;
            if (Comparator::greaterThan($this->root, $object->root)) return 1;
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
            "root" => $this->root,
        ];
    }
}