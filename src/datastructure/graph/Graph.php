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

namespace doganoo\PHPAlgorithms\Graph;

class Graph
{
    private $nodes = [];

    private function getNode($id)
    {
        if (array_key_exists($id, $this->nodes)) {
            return $this->nodes[$id];
        }
        return null;
    }

    public function addEdge(int $source, int $destination)
    {
        $sourceNode = $this->getNode($source);
        if ($sourceNode == null) {
            $sourceNode = new Node($source);
        }
        $destinationNode = $this->getNode($destination);
        if ($destinationNode == null) {
            $destinationNode = new Node($destination);
        }
        $sourceNode->addAdjacent($destinationNode);
        $this->nodes[$source] = $sourceNode;
//        $destinationNode->addAdjacent($sourceNode);
        $this->nodes[$destination] = $destinationNode;
    }

    public function hasDfs(int $source, int $destination)
    {
        $sourceNode = $this->getNode($source);
        $destinationNode = $this->getNode($destination);
        if ($destinationNode == null) {
            $destinationNode = new Node($destination);
        }
        if ($sourceNode === null) {
            return false;
        }
        return $this->hasDfsInternal($sourceNode, $destinationNode, []);
    }

    private function hasDfsInternal(Node $source, Node $destination, array $visited)
    {
        if (in_array($source->getValue(), $visited)) {
            return false;
        }
        $visited[] = $source->getValue();
        if ($source->getValue() == $destination->getValue()) {
            return true;
        }

        /** @var Node $adjacent */
        foreach ($source->getAdjacents() as $adjacent) {
            if ($this->hasDfsInternal($adjacent, $destination, $visited)) {
                return true;
            }
        }
        return false;
    }

    public function hasBfs(int $s, int $d)
    {
        $source = $this->getNode($s);
        $destination = $this->getNode($d);
        $nextToVisit = [];
        $visited = [];

        $nextToVisit[] = $source;

        while (count($nextToVisit) !== 0) {
            reset($nextToVisit);
            $key = key($nextToVisit);
            $node = $nextToVisit[$key];
            unset($nextToVisit[$key]);

            if ($node == null) {
                return false;
            }
            if ($destination == null) {
                return false;
            }
            if ($node->getValue() == $destination->getValue()) {
                return true;
            }
            if (in_array($node->getValue(), $visited)) {
                return false;
            }
            $visited[] = $node->getValue();

            foreach ($node->getAdjacents() as $child) {
                $nextToVisit[] = $child;
            }
        }
        return false;
    }


}