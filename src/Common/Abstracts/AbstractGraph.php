<?php
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

namespace doganoo\PHPAlgorithms\Common\Abstracts;


use doganoo\PHPAlgorithms\Algorithm\Various\Converter;
use doganoo\PHPAlgorithms\Common\Exception\InvalidGraphTypeException;
use doganoo\PHPAlgorithms\Common\Interfaces\IComparable;
use doganoo\PHPAlgorithms\Common\Util\Comparator;
use doganoo\PHPAlgorithms\Datastructure\Graph\Graph\Node;
use doganoo\PHPAlgorithms\Datastructure\Lists\ArrayLists\ArrayList;
use doganoo\PHPAlgorithms\Datastructure\Maps\HashMap;
use doganoo\PHPAlgorithms\Datastructure\Stackqueue\Queue;

/**
 * Class AbstractGraph
 *
 * @package doganoo\PHPAlgorithms\common\Abstracts
 */
abstract class AbstractGraph implements IComparable, \JsonSerializable {
    public const DIRECTED_GRAPH = 1;
    public const UNDIRECTED_GRAPH = 2;
    protected $nodeList = null;
    private $type = 0;
    private $converter = null;

    /**
     * AbstractGraph constructor.
     *
     * @param int $type
     * @throws InvalidGraphTypeException
     */
    protected function __construct($type = self::DIRECTED_GRAPH) {
        $this->nodeList = new ArrayList();
        $this->converter = new Converter();
        if ($type === self::DIRECTED_GRAPH || $type === self::UNDIRECTED_GRAPH) {
            $this->type = $type;
        } else {
            throw new InvalidGraphTypeException();
        }
    }

    /**
     * @param $value
     * @return bool
     */
    public function createNode($value): bool {
        $node = new Node($value);
        return $this->addNode($node);
    }

    /**
     * @param Node $node
     * @return bool
     */
    public function addNode(Node $node): bool {
        return $this->nodeList->add($node);
    }

    /**
     * @param Node $startNode
     * @param Node $endNode
     * @return bool
     */
    public abstract function addEdge(Node $startNode, Node $endNode): bool;

    /**
     * @param $object
     * @return int
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    public function compareTo($object): int {
        if ($object instanceof AbstractGraph) {
            if (Comparator::equals($this->getRoot(), $object->getRoot())) return 0;
            if (Comparator::lessThan($this->getRoot(), $object->getRoot())) return -1;
            if (Comparator::greaterThan($this->getRoot(), $object->getRoot())) return 1;
        }
        return -1;
    }

    /**
     * @return Node|null
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     */
    public function getRoot(): ?Node {
        return ($this->nodeList === null ||
            $this->nodeList->size() === 0)
            ? null : $this->nodeList->get(0);
    }

    /**
     * Specify data which should be serialized to JSON
     *
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() {
        return [
            "node_list" => $this->nodeList
            , "type" => $this->type,
        ];
    }

    /**
     * @param AbstractGraph $graph
     * @return AbstractGraph|null
     * @throws \doganoo\PHPAlgorithms\Common\Exception\IndexOutOfBoundsException
     * @throws \doganoo\PHPAlgorithms\common\Exception\InvalidKeyTypeException
     * @throws \doganoo\PHPAlgorithms\common\Exception\UnsupportedKeyTypeException
     */
    public function deepCopy(AbstractGraph $graph): ?AbstractGraph {
        $root = $graph->getRoot();
        if (null === $root) return null;

        $q = new Queue();
        $m = new HashMap();

        $newRoot = new Node($root->getValue());

        $q->enqueue($root);
        $m->put($root, $newRoot);

        while (!$q->isEmpty()) {
            /** @var Node $node */
            $node = $q->dequeue();

            /** @var Node $adjacent */
            foreach ($node->getAdjacents() as $adjacent) {
                if ($m->containsKey($adjacent)) {
                    /** @var Node $x */
                    $x = $m->get($node);
                    /** @var Node $y */
                    $y = $m->get($adjacent);
                    $x->addAdjacent($y);
                } else {
                    $copy = new Node($adjacent->getValue());
                    $m->put($adjacent, $copy);
                    /** @var Node $adj */
                    $adj = $m->get($adjacent);
                    $adj->addAdjacent($copy);
                    $q->enqueue($adjacent);
                }
            }

            $nodeList = $this->converter->hashMapToArrayList($m);
            $this->nodeList = $nodeList;
            return $this;
        }
    }

    /**
     * returns the number of sub graphs
     *
     * @return int
     */
    public function numberOfSubGraph(): int {
        if (null === $this->getNodes()) return 0;
        $c = 0;
        $v = new ArrayList();

        foreach ($this->getNodes() as $node) {
            if ($v->containsValue($node)) continue;
            $c++;
            $this->flood($node, $v);
        }
        return $c;
    }

    /**
     * @return ArrayList|null
     */
    public function getNodes(): ?ArrayList {
        return $this->nodeList;
    }

    /**
     * @param Node $node
     * @param ArrayList $v
     */
    private function flood(Node $node, ArrayList &$v): void {
        foreach ($node->getAdjacents() as $adjacent) {
            if ($v->containsValue($adjacent)) continue;
            $v->add($adjacent);
        }
    }


}