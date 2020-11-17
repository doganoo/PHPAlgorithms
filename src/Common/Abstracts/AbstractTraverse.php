<?php
declare(strict_types=1);
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

use function is_callable;

/**
 * Class AbstractTraverse
 *
 * @package doganoo\PHPAlgorithms\common\Abstracts
 */
abstract class AbstractTraverse {

    /** @var $callable callable|null */
    protected $callable = null;

    /**
     * @return mixed
     */
    public abstract function traverse();

    /**
     * @param $value
     */
    public function visit($value) {
        $callable = $this->callable;
        if (null === $this->callable
            && !is_callable($this->callable)) {
            $callable = function ($otherValue) {
                echo $otherValue;
            };
        }
        $callable($value);
    }

    /**
     * @param callable $callable
     */
    public function setCallable(callable $callable) {
        $this->callable = $callable;
    }

}