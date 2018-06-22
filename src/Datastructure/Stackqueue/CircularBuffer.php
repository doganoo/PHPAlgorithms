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

namespace doganoo\PHPAlgorithms\Datastructure\Stackqueue;

/**
 * Class CircularBuffer
 *
 * see https://www.youtube.com/watch?v=ia__kyuwGag&frags=pl%2Cwn for more detail
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Stackqueue
 */
class CircularBuffer {
    private $elements = null;
    private $head = 0;
    private $tail = 0;
    private $size = 0;

    /**
     * CircularBuffer constructor.
     *
     * @param int $size
     */
    public function __construct(\int $size = 128) {
        $this->size = $size;
        $this->elements = \array_fill(0, $size, null);
        $this->clear();
    }

    /**
     * resets the pointers of the buffer so that all indices
     * are free to rewrite.
     */
    public function clear() {
        $this->head = 0;
        $this->tail = 0;
    }

    /**
     * enqueues a data at the head of the circular buffer.
     * If the buffer is full, the method will insert the
     * data at the "beginning" without warning.
     *
     * @param $data
     * @return bool
     */
    public function enqueue($data): bool {
        if (null === $data) {
            return false;
        }
        if ($this->isFull()) {
            return false;
        }
        $this->head = $this->head % $this->size;
        $this->elements[$this->head] = $data;
        $this->head++;
        return true;
    }

    /**
     * returns whether the circular buffer is full or not
     *
     * @return bool
     */
    public function isFull(): bool {
        return $this->tail === (($this->head + 1) % $this->size);
    }

    /**
     * dequeues a value from the tail of the circular buffer.
     *
     * @return mixed
     */
    public function dequeue() {
        if ($this->isEmpty()) {
            return false;
        }
        $this->tail = $this->tail % $this->size;
        $data = $this->elements[$this->tail];
        $this->tail++;
        return $data;
    }

    /**
     * returns whether the circular buffer is empty or not
     *
     * @return bool
     */
    public function isEmpty(): bool {
        return $this->head === $this->tail;
    }
}