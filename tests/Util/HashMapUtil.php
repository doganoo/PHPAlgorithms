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

namespace doganoo\PHPAlgorithmsTest\Util;

use doganoo\PHPAlgorithms\Datastructure\Lists\Node;
use doganoo\PHPAlgorithms\Datastructure\Maps\HashMap;

/**
 * Class HashMapUtil - utility class for testing hash maps
 */
class HashMapUtil {

    /**
     * HashMapUtil constructor is private in order to ensure that the class is not instantiable.
     */
    public function __construct() {
    }

    /**
     * creates a hash map with $number elements
     *
     * @param int $number
     * @return HashMap
     * @throws \doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException
     */
    public static function getHashMap(int $number) {
        $hashMap = new HashMap();
        for ($i = 0; $i < $number; $i++) {
            $node = new Node();
            $node->setKey($i);
            $node->setValue(md5((string) $i));
            $hashMap->addNode($node);
        }
        return $hashMap;
    }

}