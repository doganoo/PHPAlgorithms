<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2020 Dogan Ucar, <dogan@dogan-ucar.de>
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

namespace doganoo\PHPAlgorithms\Datastructure\Table;

use doganoo\PHPAlgorithms\Common\Exception\InvalidKeyTypeException;
use doganoo\PHPAlgorithms\Common\Exception\UnsupportedKeyTypeException;
use doganoo\PHPAlgorithms\Common\Util\MapUtil;

/**
 * Class ConsistentHashTable
 * @package doganoo\PHPAlgorithms\Datastructure\Table
 * @author  Dogan Ucar <dogan@dogan-ucar.de>
 *          TODO implement!
 */
class ConsistentHashTable {

    private $nodes;

    public function __construct() {
        $this->nodes = [];
    }

    /**
     * returns the hash that is used to calculate the
     * bucket index.
     *
     * @param $key
     *
     * @return int
     * @throws InvalidKeyTypeException
     * @throws UnsupportedKeyTypeException
     */
    private function getHash($key): int {
        $key = MapUtil::normalizeKey($key);
        return crc32((string) $key);
    }

}