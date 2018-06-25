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

use doganoo\PHPAlgorithms\Datastructure\Stackqueue\FixedQueue;
use doganoo\PHPAlgorithms\Datastructure\Stackqueue\FixedStack;

/**
 * Class StackQueueTest class testing Stacks and Queues
 */
class FixedStackTest extends \PHPUnit\Framework\TestCase {
    /**
     * Stack class test
     */
    public function testStack() {
        $stack = new FixedStack(2);
        $added = $stack->push(new stdClass());
        $this->assertTrue($added === true);
        $stack->push(new Exception());
        $this->assertTrue($stack->isEmpty() == false);
        $this->assertTrue($stack->stackSize() === 2);
        $added = $stack->push(new stdClass());
        $this->assertTrue($added === false);
        $this->assertTrue($stack->stackSize() === 2);

        $class = $stack->peek();
        $this->assertTrue($class instanceof Exception);
        $this->assertTrue($stack->isEmpty() == false);

        $class = $stack->peek();
        $this->assertTrue($class instanceof stdClass);
        $this->assertTrue($stack->isEmpty() == true);
    }

    /**
     * Queue class test
     */
    public function testQueue() {
        $queue = new FixedQueue(2);
        $queue->enqueue(new stdClass());
        $queue->enqueue(new Exception());
        $this->assertTrue($queue->isEmpty() == false);
        $added = $queue->enqueue(new Exception());
        $this->assertTrue($added === false);
        $this->assertTrue($queue->queueSize() === 2);

        $class = $queue->dequeue();
        $this->assertTrue($class instanceof Exception);
        $this->assertTrue($queue->isEmpty() == false);

        $class = $queue->dequeue();
        $this->assertTrue($class instanceof stdClass);
        $this->assertTrue($queue->isEmpty() == true);
    }
}