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

namespace doganoo\PHPAlgorithms\Datastructure\Vector;

/**
 * Class IntegerVector
 * @package doganoo\PHPAlgorithms\Datastructure\Vector
 */
class IntegerVector {
    /** @var array|null $array */
    private $array = null;

    /**
     * IntegerVector constructor.
     */
    public function __construct() {
        $this->array = [];
    }

    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof IntegerVector) {
            if (\count(\array_diff($this->array, $object->array)) === 0) return 0;
            if (\count($this->array) < \count($object->array)) return -1;
            if (\count($this->array) > \count($object->array)) return 1;
        }
        return -1;
    }

    /**
     * sets a value in the vector
     *
     * @param int $value
     * @return bool
     */
    public function set(int $value): bool {
        $size = $this->size();
        if (0 > $this->size()) {
            $size++;
        }
        $this->array[$size] = $value;
        return true;
    }

    public function size(): int {
        $array = \array_filter($this->array, function ($k, $v) {
            return null !== $v;
        }, \ARRAY_FILTER_USE_BOTH);
        return \count($array);
    }

    /**
     * returns the dot product with $vector
     *
     * @param IntegerVector $vector
     * @return int
     */
    public function dotProduct(IntegerVector $vector): int {
        $i = 0;
        $j = 0;
        $result = 0;

        while ($i < $this->size() && $j < $vector->size()) {
            $result = $result + ($this->get($i) * $this->get($j));
            $i++;
            $j++;
        }
        return $result;
    }

    /**
     * retrieves the value in the vector
     *
     * @param int $index
     * @return int|null
     */
    public function get(int $index): ?int {
        if (isset($this->array[$index])) {
            return $this->array[$index];
        }
        return null;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            "array" => $this->array
        ];
    }
}