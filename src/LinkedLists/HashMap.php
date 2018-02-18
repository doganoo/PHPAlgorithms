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

namespace doganoo\PHPAlgorithms\LinkedLists;


class HashMap
{
    private $bucket = null;
    private $maxSize = 128;

    public function __construct()
    {
        $this->bucket = [];
    }

    public function contains(string $value)
    {
        /**
         * @var string $arrayIndex
         * @var Node $node
         */
        foreach ($this->bucket as $arrayIndex => $node) {
            $tmp = $node;
            while ($tmp !== null) {
                if ($tmp->getValue() == $value) {
                    return true;
                }
                $tmp = $tmp->getNext();
            }
            return false;
        }
    }


    public
    function get(string $value)
    {
        /**
         * @var string $arrayIndex
         * @var Node $node
         */
        foreach ($this->bucket as $arrayIndex => $node) {
            $tmp = $node;
            while ($tmp !== null) {
                if ($tmp->getValue() == $value) {
                    return $tmp->getValue();
                }
                $tmp = $tmp->getNext();
            }
            return null;
        }
    }

    public function remove($value)
    {

        /**
         * @var string $arrayIndex
         * @var Node $node
         */
        foreach ($this->bucket as $arrayIndex => $node) {
            /** @var Node $current */
            $current = $previous = $node;

            while ($current->getValue() != $value) {
                $previous = $current;
                $current = $current->getNext();
            }

            // For the first node
            if ($current->getValue() == $previous->getValue()) {
                $node = $current->getNext();
            }

            $previous->setNext($current->getNext());
        }

    }

    public
    function add(int $key, string $value)
    {
        $hash = $this->getHash($key);
        $arrayIndex = $this->getArrayIndex($hash);

        /**
         * @var int $_buckId
         * @var Node $node
         */
        foreach ($this->bucket as $_buckId => $node) {
            //falls der Key schon in der Liste vorhanden ist
            //ignoriere ihn!
            if ($node->getKey() == $key) {
                return;
            }
        }
        $head = null;
        if (isset($this->bucket[$arrayIndex])) {
            /** @var Node $head */
            $head = $this->bucket[$arrayIndex];
        }
        //if there is no Node yet, simple create one and assign it to the buckets array
        if ($head === null) {
            $head = new Node();
            $head->setKey($key);
            $head->setValue($value);
            $this->bucket[$arrayIndex] = $head;
        } else {
            //if there is one Node in the bucket,
            //first check if the keys are equal
            //if so: then do not create a new Node: simply overwrite the existing one
            //if not: create a new Node
            if ($this->checkForDuplicate($head, $key)) {
                $head->setValue($value);
                $this->bucket[$arrayIndex] = $head;
            } else {
                $newNode = new Node();
                $newNode->setKey($key);
                $newNode->setValue($value);
                $newNode->setNext($head);
                $this->bucket[$arrayIndex] = $newNode;
            }
        }
    }

    private
    function checkForDuplicate(Node $node, int $key)
    {
        if ($node->getNext() !== null) {
            return $this->checkForDuplicate($node->getNext(), $key);
        }
        if ($node->getKey() === $key) {
            return true;
        }
        return false;
    }

    private
    function getHash(int $key): int
    {
        return crc32($key);
    }

    private
    function getArrayIndex(int $hash): int
    {
        return $hash % $this->maxSize;
    }

    private
    function prepareString(Node $node): string
    {
        $string = "" . $node;
        if ($node->getNext() !== null) {
            $string .= $this->prepareString($node->getNext());
        }
        return $string;
    }

    public
    function printList()
    {
        foreach ($this->bucket as $key => $value) {
            echo "bucketID: $key ";
            $string = $this->prepareString($value);
            echo "=> node: $string \n";
        }
    }

}