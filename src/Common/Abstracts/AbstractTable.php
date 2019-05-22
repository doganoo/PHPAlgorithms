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

namespace doganoo\PHPAlgorithms\Common\Abstracts;

/**
 * Class AbstractTable
 * @package doganoo\PHPAlgorithms\Common\Abstracts
 */
abstract class AbstractTable {
    /** @var array|null $table */
    protected $table = null;

    /**
     * AbstractTable constructor.
     */
    public function __construct() {
        $this->table = [];
    }

    /**
     * @param $key
     * @param $value
     */
    abstract public function put($key, $value):void;

    /**
     * @param $key
     * @return mixed
     */
    abstract public function get($key);

    /**
     * @param $key
     * @return bool
     */
    public function delete($key):bool {
        if (false === isset($this->table[$key])) return false;
        unset($this->table[$key]);
        return true;
    }

    /**
     * @param $key
     * @return bool
     */
    public function has($key):bool {
        return null !== $this->get($key);
    }

    /**
     * @return array
     */
    public function getKeys():array {
        return array_keys($this->table);
    }

}