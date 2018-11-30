<?php


namespace Various;


use doganoo\PHPAlgorithms\Datastructure\Various\MapReduce\MapReduce;
use MapReduce\Mapper;
use MapReduce\Reducer;
use PHPUnit\Framework\TestCase;

class MapReduceTest extends TestCase {
    public function testMapReduce() {
        $mapReduce = new MapReduce([1, 2, 3, 4, 5, 6, 7, 8]);
        $mapper = new Mapper();
        $reducer = new Reducer();
        $mapReduce->map($mapper);
        $mapReduce->reduce($reducer);
        $this->assertTrue($mapReduce->getResult() === []);
    }

}