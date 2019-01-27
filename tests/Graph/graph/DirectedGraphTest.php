<?php


use doganoo\PHPAlgorithms\Datastructure\Graph\Graph\DirectedGraph;
use doganoo\PHPAlgorithms\Datastructure\Graph\Graph\Node;

class DirectedGraphTest extends \PHPUnit\Framework\TestCase {

    public function testAdd() {
        $graph = new DirectedGraph();
        $this->assertTrue($graph->addNode(new Node(1)) === true);
    }

    public function testSubGraphSize() {
        $one = new Node(1);
        $nine = new Node(9);
        $five = new Node(5);

        $one->addAdjacent($nine);
        $one->addAdjacent($five);

        $two = new Node(2);
        $four = new Node(4);

        $two->addAdjacent($four);

        $six = new Node(6);

        $graph = new DirectedGraph();
        $graph->addNode($one);
        $graph->addNode($two);
        $graph->addNode($six);

        $this->assertTrue(3 === $graph->numberOfSubGraph());
    }

}