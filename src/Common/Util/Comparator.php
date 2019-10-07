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

namespace doganoo\PHPAlgorithms\Common\Util;

use doganoo\PHPAlgorithms\Common\Interfaces\IComparable;
use function is_object;

/**
 * Class Comparator
 *
 * @package doganoo\PHPAlgorithms\common\Util
 */
class Comparator {

    /**
     * Comparator constructor.
     */
    private function __construct() {

    }

    /**
     * @param $that
     * @param $other
     * @return bool
     */
    public static function equals($that, $other): bool {
        if ($that instanceof IComparable) {
            return $that->compareTo($other) === 0;
        }
        if (is_object($that)) {
            if (is_object($other)) {
                return $that == $other;
            }
            return false;
        }
        if (is_object($other)) {
            if (is_object($that)) {
                return $other == $that;
            }
            return false;
        }
        return $that == $other;
    }

    /**
     * @param $that
     * @param $other
     * @return bool
     */
    public static function notEquals($that, $other):bool {
        return false === Comparator::equals($that, $other);
    }

    /**
     * @param $that
     * @param $other
     * @return bool
     */
    public static function lessThan($that, $other): bool {
        if ($that instanceof IComparable) {
            return $that->compareTo($other) === -1;
        }
        if (is_object($that)) {
            if (is_object($other)) {
                return $that < $other;
            }
            return false;
        }
        if (is_object($other)) {
            if (is_object($that)) {
                return $other < $that;
            }
            return false;
        }
        return $that < $other;
    }

    /**
     * @param $that
     * @param $other
     * @return bool
     */
    public static function lessThanEqual($that, $other): bool {
        if ($that instanceof IComparable) {
            return $that->compareTo($other) === -1;
        }
        if (is_object($that)) {
            if (is_object($other)) {
                return $that <= $other;
            }
            return false;
        }
        if (is_object($other)) {
            if (is_object($that)) {
                return $other <= $that;
            }
            return false;
        }
        return $that <= $other;
    }

    /**
     * @param $that
     * @param $other
     * @return bool
     */
    public static function greaterThan($that, $other): bool {
        if ($that instanceof IComparable) {
            return $that->compareTo($other) === 1;
        }
        if (is_object($that)) {
            if (is_object($other)) {
                return $that > $other;
            }
            return false;
        }
        if (is_object($other)) {
            if (is_object($that)) {
                return $other > $that;
            }
            return false;
        }
        return $that > $other;
    }

    /**
     * @param $that
     * @param $other
     * @return bool
     */
    public static function greaterThanEqual($that, $other): bool {
        if ($that instanceof IComparable) {
            return $that->compareTo($other) === 1;
        }
        if (is_object($that)) {
            if (is_object($other)) {
                return $that >= $other;
            }
            return false;
        }
        if (is_object($other)) {
            if (is_object($that)) {
                return $other >= $that;
            }
            return false;
        }
        return $that >= $other;
    }

}