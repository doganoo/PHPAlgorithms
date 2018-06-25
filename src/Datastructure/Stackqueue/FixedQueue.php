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
 * Class FixedQueue extends Queue
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Stackqueue
 */
class FixedQueue extends Queue {
    /** @var int $maxSize the maximum number of elements which is capable by the queue */
    private $maxSize = 0;

    /**
     * FixedQueue constructor.
     *
     * @param int $maxSize
     */
    public function __construct(int $maxSize) {
        $this->maxSize = $maxSize;
    }

    /**
     * returns whether the element is valid or not.
     * Checks among other things also the number of elements
     *
     * @return bool
     */
    protected function isValid(): bool {
        $parent = parent::isValid();
        $maxSize = parent::queueSize() < $this->maxSize;
        return $parent && $maxSize;
    }
}