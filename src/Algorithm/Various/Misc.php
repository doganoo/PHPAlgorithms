<?php
declare(strict_types=1);
/**
 * MIT License
 *
 * Copyright (c) 2018 Dogan Ucar, <dogan@dogan-ucar.de>
 *
 * @author Eugene Kirillov <eug.krlv@gmail.com>
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

namespace doganoo\PHPAlgorithms\Algorithm\Various;

use doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayList\ArrayList;


/**
 * Class Misc
 * @package doganoo\PHPAlgorithms\Algorithm\Various
 */
class Misc {

    /**
     * This method is imaginary, in order to have a better understanding how the
     * underlying algorithm works. It can also be seen as a hotline algorithm
     * (do we have enough persons to respond incoming calls) or for an parking
     * system, for instance.
     *
     * @param ArrayList $arrivals
     * @param ArrayList $departures
     * @param int $maxCapacity
     * @return bool
     * @throws IndexOutOfBoundsException
     */
    public function hotelCapacity(ArrayList $arrivals, ArrayList $departures, int $maxCapacity): bool {
        /*
         * lets imagine we have a hotel booking system.
         * The $arrivals list holds the days on that persons
         * arrive.
         * The $departures list holds the days on that
         * persons leave the hotel.
         */
        $arrivalSize = $n = $arrivals->size();
        $departureSize = $departures->size();

        // base case: if the lists have an unequal
        // number of elements, stop processing
        if (Comparator::notEquals($arrivalSize, $departureSize)) return false;

        /*
         * We need to sort the lists. This is critical
         * for the following algorithm, as we need to
         * know the chronological sequence.
         */
        $arrivals->sort();
        $departures->sort();

        $aIndex = 0;
        $bIndex = 0;
        $capacity = 0;

        while ($aIndex < $n && $bIndex < $n) {
            $aVal = $arrivals->get($aIndex);
            $bVal = $departures->get($bIndex);

            /*
             * This is simple logic: if the arrival day
             * is less than the departure day, we have
             * one more guest in the hotel. Therefore, we
             * need to increment $capacity.
             *
             * Otherwise (departure day is less than
             * or equal arrival day), we have one
             * room freed and can decrement.
             */
            Comparator::lessThan($aVal, $bVal) ?
                $capacity++ :
                $capacity--;

            // If we exhausted the maximum capacity, we
            // return false
            if (Comparator::greaterThan($capacity, $maxCapacity)) return false;

            $aIndex++;
            $bIndex++;
        }

        return true;
    }

}