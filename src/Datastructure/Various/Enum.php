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

namespace doganoo\PHPAlgorithms\Datastructure\Various;

use doganoo\PHPAlgorithms\Common\Exception\NullNotAllowedException;
use doganoo\PHPAlgorithms\Common\Exception\ValueNotAllowedException;
use doganoo\PHPAlgorithms\Common\Interfaces\IComparable;

/**
 * Class Enum
 * @package doganoo\PHPAlgorithms\Datastructure\Various
 */
class Enum implements IComparable {

    private bool  $nullAllowed;
    private array $allowedValues;
    private       $value = null;

    /**
     * Enum constructor.
     * @param array $allowedValues
     * @param bool  $nullAllowed
     */
    public function __construct(array $allowedValues, bool $nullAllowed = false) {
        $this->nullAllowed   = $nullAllowed;
        $this->allowedValues = $allowedValues;
    }

    /**
     * @param $value
     * @throws NullNotAllowedException
     * @throws ValueNotAllowedException
     */
    public function setValue($value): void {
        $isNull = $this->isNull($value);

        if (false === $this->nullAllowed && true === $isNull) {
            throw new NullNotAllowedException();
        }

        if (false === in_array($value, $this->allowedValues)) {
            throw new ValueNotAllowedException();
        }

        $this->value = $value;

    }

    /**
     * @return mixed
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * @param $value
     * @return bool
     */
    private function isNull($value): bool {
        return "" === $value || null === $value;
    }


    /**
     * @param $object
     * @return int
     */
    public function compareTo($object): int {
        if ($object instanceof Enum) {
            if (count($this->value) === count($object->value)) return IComparable::EQUAL;
        }
        return IComparable::IS_LESS;
    }

}