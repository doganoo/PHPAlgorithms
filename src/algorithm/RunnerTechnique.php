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

namespace doganoo\PHPAlgorithms\Lists;


class RunnerTechnique
{

    public function hasLoop(Node $head)
    {
        $tortoise = $head;
        $hare = $head;

        while ($tortoise !== null && $hare->getNext() !== null &&
            $hare->getNext()->getNext() !== null) {
            $hare = $hare->getNext()->getNext();

            if ($tortoise->getValue() === $hare->getValue()) {
                return true;
            }

            $tortoise = $tortoise->getNext();
        }
        return false;
    }

    public function findKthElementFromEnd(Node $head, int $k)
    {
        $listSize = 0;

        $temp = $head;
        while ($temp !== null) {
            $temp = $temp->getNext();
            $listSize++;
        }

        if ($k > $listSize) {
            return null;
        }
        $resultNode = $head;
        for ($i = 1; $i < $listSize - $k + 1; $i++) {
            $resultNode = $resultNode->getNext();
        }

        return $resultNode;

    }
}