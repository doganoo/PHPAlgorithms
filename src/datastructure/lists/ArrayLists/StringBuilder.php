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

namespace doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists;

use doganoo\PHPAlgorithms\Datastructure\Stackqueue\Queue;
use doganoo\PHPAlgorithms\Datastructure\Stackqueue\Stack;

/**
 * Class StringBuilder
 *
 * @package doganoo\PHPAlgorithms\Lists\ArrayLists
 */
class StringBuilder {
    /** @var ArrayList $arrayList */
    private $arrayList = null;

    /**
     * StringBuilder constructor.
     *
     * @param null $value
     */
    public function __construct($value = null) {
        $this->arrayList = new ArrayList();
        if (\is_string($value)) {
            $this->append($value);
        } else if (\is_int($value)) {
            for ($i = 0; $i < $value; $i++) {
                $this->arrayList->add("");
            }
        }
    }

    /**
     * appends a string to the list
     *
     * @param string $string
     */
    public function append(string $string) {
        for ($i = 0; $i < \strlen($string); $i++) {
            $this->arrayList->add($string[$i]);
        }
    }

    /**
     * returns the number of elements in the list
     *
     * @return int
     */
    public function capacity(): int {
        return $this->arrayList->size();
    }

    /**
     * returns the char at $index
     *
     * @param int $index
     * @return mixed
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    public function charAt(int $index) {
        return $this->arrayList->get($index);
    }

    /**
     * deletes the range between $start and $end
     *
     * @param int $start
     * @param int $end
     */
    public function delete(int $start, int $end) {
        $this->arrayList->removeRange($start, $end);
    }

    /**
     * $deletes the char at $index
     *
     * @param $index
     */
    public function deleteCharAt($index) {
        $this->arrayList->removeRange($index, $index);
    }

    /**
     * returns the index of $value
     *
     * @param string $value
     * @return string
     */
    public function indexOf(string $value) {
        return $this->arrayList->indexOf($value);
    }

    /**
     * inserts a value at index $index
     *
     * @param int    $index
     * @param string $string
     */
    public function insert(int $index, string $string) {
        if (\strlen($string) > 1) {
            $string = $string[0];
        }
        $this->arrayList->addToIndex($index, $string);
    }

    /**
     * returns the number of elements of the list
     *
     * @return int
     */
    public function length() {
        return $this->arrayList->length();
    }

    /**
     * reverses the current list
     *
     * @return StringBuilder
     */
    public function reverse() {
        $stringBuilder = $this->arrayListToStringBuilder($this->arrayList, true);
        return $stringBuilder;
    }

    /**
     * converts a array list to a string builder
     *
     * @param ArrayList $arrayList
     * @param bool      $reverse
     * @return StringBuilder
     */
    private function arrayListToStringBuilder(ArrayList $arrayList, bool $reverse = false) {
        $stringBuilder = new StringBuilder();
        if ($reverse) {
            $stack = new Stack();
            foreach ($arrayList as $item) {
                if (null !== $item) {
                    $stack->push($item);
                }
            }
            while (!$stack->isEmpty()) {
                $stringBuilder->append($stack->peek());
            }
        } else {
            $queue = new Queue();
            foreach ($arrayList as $item) {
                if (null !== $item) {
                    $queue->enqueue($item);
                }

            }
            while (!$queue->isEmpty()) {
                $stringBuilder->append($queue->dequeue());
            }
        }
        return $stringBuilder;
    }

    /**
     * returns a subsequence from $start to $end
     *
     * @param int $start
     * @param int $end
     * @return StringBuilder
     */
    public function subSequence(int $start, int $end) {
        $arrayList = $this->arrayList->subList($start, $end);
        $stringBuilder = $this->arrayListToStringBuilder($arrayList);
        return $stringBuilder;
    }

    /**
     * trims the number of elements to the real size
     */
    public function trimToSize() {
        $this->arrayList->trimToSize();
    }

    /**
     * string representation of the class
     *
     * @return string
     */
    public function __toString() {
        $string = "";
        foreach ($this->arrayList as $item) {
            $string .= $item;
        }
        return $string;
    }
}