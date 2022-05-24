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

namespace doganoo\PHPAlgorithms\Algorithm\Search;

use doganoo\PHPAlgorithms\Common\Abstracts\AbstractLinkedList;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Lists\Node;

/**
 * Class LinkedListSearch
 *
 * @package doganoo\PHPAlgorithms\Lists
 */
class LinkedListSearch {

    /**
     * also known as the Runner Technique
     *
     * @param AbstractLinkedList $linkedList
     * @return bool
     * @deprecated this method belongs to doganoo\PHPAlgorithms\Common\Abstracts\AbstractLinkedList and is moved there. Please use  this method instead.
     */
    public function hasLoop(AbstractLinkedList $linkedList): bool {
        $tortoise = $linkedList->getHead();
        $hare     = $linkedList->getHead();

        while ($tortoise !== null && $hare->getNext() !== null &&
            $hare->getNext()->getNext() !== null) {
            $hare = $hare->getNext()->getNext();

            if (Comparator::equals($tortoise->getValue(), $hare->getValue())) {
                return true;
            }

            $tortoise = $tortoise->getNext();
        }
        return false;
    }

    /**
     * @param AbstractLinkedList $linkedList
     * @param int                $k
     * @return Node|null
     */
    public function findKthElementFromEnd(AbstractLinkedList $linkedList, int $k): ?Node {
        $listSize = 0;
        $temp     = $linkedList->getHead();
        while ($temp !== null) {
            $temp = $temp->getNext();
            $listSize++;
        }
        if ($k > $listSize) {
            return null;
        }
        $resultNode = $linkedList->getHead();
        for ($i = 1; $i < $listSize - $k + 1; $i++) {
            $resultNode = $resultNode->getNext();
        }
        return $resultNode;

    }

}