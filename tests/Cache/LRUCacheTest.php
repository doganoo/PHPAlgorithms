<?php
declare(strict_types=1);
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

namespace doganoo\PHPAlgorithmsTest\Cache;

use doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException;
use doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException;
use doganoo\PHPAlgorithms\Datastructure\Cache\LRUCache;
use PHPUnit\Framework\TestCase;

class LRUCacheTest extends TestCase {

    /**
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    public function testCache() {
        $cache = new LRUCache();
        $cache->put("a", 1);
        $cache->put("b", 2);
        $value = $cache->get("a");
        $this->assertTrue($value === 1);
        $last = $cache->last();
        $this->assertTrue($last === "a");
        $deleted = $cache->delete("a");
        $this->assertTrue($deleted === true);
        $last = $cache->last();
        $this->assertTrue($last === "b");
    }

    /**
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    public function testCacheWithSize() {
        $cache = new LRUCache(2);
        $cache->put("a", 1);
        $cache->put("b", 2);
        $this->assertTrue($cache->last() === "b");
        $cache->put("c", 3);
        $this->assertTrue($cache->get("a") === null);
        $value = $cache->get("b");
        $this->assertTrue($value === 2);
        $cache->put("d", 4);
        $this->assertTrue($cache->get("c") === null);
    }

}