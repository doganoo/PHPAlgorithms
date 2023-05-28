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

namespace doganoo\PHPAlgorithms\Datastructure\Vector\BitVector;

use doganoo\PHPAlgorithms\Common\Exception\InvalidBitLengthException;
use doganoo\PHPAlgorithms\Common\Interfaces\IVector;
use function array_diff;
use function count;
use function is_int;

/**
 * Class Vector
 *
 * @package doganoo\PHPAlgorithms\Datastructure\Maps
 */
class IntegerVector implements IVector {

    /** @var array $array */
    private array $array;
    /** @var int $bitLength */
    private int $bitLength = 32;

    /**
     * Vector constructor.
     *
     * @param int $bitLength
     * @throws InvalidBitLengthException
     */
    public function __construct(int $bitLength = 32) {
        $this->array = [];
        if (0 === $bitLength) throw new InvalidBitLengthException();
        $this->bitLength = $bitLength;
    }


    /**
     * sets a value in the vector
     *
     * @param $value
     * @return bool
     */
    public function set($value): bool {
        //TODO throw exception instead?
        if (is_int($value)) {
            $info = $this->getIndexAndMask($value);
            $i    = $info["i"];
            $k    = $info["k"];

            $flag = 1;
            $flag = $flag << $k;

            if (isset($this->array[(int) $i])) {
                $this->array[(int) $i] |= $flag;
            } else {
                $this->array[(int) $i] = $flag;
            }
            return true;
        }
        return false;
    }

    private function getIndexAndMask(int $value): array {
        $i = $value / $this->bitLength;
        $k = $value % $this->bitLength;

        $info      = [];
        $info["i"] = $i;
        $info["k"] = $k;
        return $info;
    }

    /**
     * retrieves the value in the vector
     *
     * @param $value
     * @return mixed
     */
    public function get($value) {
        //TODO throw exception instead?!
        if (is_int($value)) {
            $info = $this->getIndexAndMask($value);
            $i    = $info["i"];
            $k    = $info["k"];

            $flag = 1;
            $flag = $flag << $k;

            if (isset($this->array[(int) $i])) return (($this->array[(int) $i] & $flag) !== 0);
            return false;
        }
        return false;
    }

    /**
     * clears the value in the vector
     *
     * @param $value
     * @return bool
     */
    public function clear($value): bool {
        //TODO throw exception insted?!
        if (is_int($value)) {
            $info = $this->getIndexAndMask($value);
            $i    = $info["i"];
            $k    = $info["k"];

            $flag = 1;
            $flag = $flag << $k;
            $flag = !$flag;

            if (isset($this->array[$i])) {
                $this->array[$i] &= $flag;
            } else {
                $this->array[$i] = $this->array[$i] & $flag;
            }
            return true;
        }
        return false;
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {

        if ($object instanceof IntegerVector) {
            if (count(array_diff($this->array, $object->array)) === 0) return 0;
            if (count($this->array) < count($object->array)) return -1;
            if (count($this->array) > count($object->array)) return 1;
        }

        return -1;
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return array data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize(): array {
        return [
            "array"        => $this->array
            , "bit_length" => $this->bitLength,
        ];
    }

}