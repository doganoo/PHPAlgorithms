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

namespace doganoo\PHPAlgorithms\StackQueue;


/**
 * PHP implementation of a Queue
 * See here for more information: https://www.geeksforgeeks.org/queue-set-1introduction-and-array-implementation/
 *
 * Queues work according to the FIFO principe (FIRST IN FIRST OUT). This means, that the first element
 * pushed to the enqueued is dequeued first as well (imagine a ticket line for concerts where people are
 * waiting to buy a ticket).
 *
 *
 * Class Queue
 * @package StackQueue
 */
class Queue
{
    private $queue = [];

    private $size = 0;

    /**
     * this methods adds an item to the queue to the last index
     *
     * @param int $item
     * @return bool
     */
    public function enqueue(int $item): bool
    {
        if (!$this->isValid()) {
            return false;
        }
        $this->queue[] = $item;
        return true;
    }

    /**
     * this method removes the first element from the queue and returns it
     *
     * @return int
     */
    public function dequeue(): int
    {
        return array_shift($this->queue);
    }

    /**
     * returns the first element from the queue
     *
     * @return int
     */
    public function front(): int
    {
        if (isset($this->queue[0])) {
            return $this->queue[0];
        }
        return -1;
    }

    /**
     * returns the last item from the queue
     *
     * @return int
     */
    public function rear(): int
    {
        return $this->queue[$this->queueSize()];

    }

    /**
     * stores the number of items of the queue to the size member of this class and returns it
     *
     * @return int
     */
    private function queueSize(): int
    {
        $this->size = count($this->queue);
        return $this->size;
    }

    /**
     * checks if the stack element (the array) is null
     *
     * @return bool
     */
    private function isValid(): bool
    {
        return $this->queue !== null;
    }

    public function printList(): bool
    {
        if (!$this->isValid()) {
            echo "0";
            echo "\n";
            return true;
        }
        if ($this->queueSize() == 0) {
            echo "0";
            echo "\n";
            return true;
        }

        foreach ($this->queue as $key => $value) {
            echo "$key => $value";
            echo "\n";
        }
        return true;
    }
}