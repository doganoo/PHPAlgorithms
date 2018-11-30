<?php

namespace MapReduce;


use doganoo\PHPAlgorithms\Common\Interfaces\MapReduce\IReducer;

class Reducer implements IReducer {

    /**
     * returns a callable that reduces $value and $key in $reduced
     *
     * @param $key
     * @param $value
     * @param array $reduced
     * @return Callable
     */
    public function getReducer($key, $value, array &$reduced): Callable {
        return function (int $key, $value, $reduced) {
            $reduced[] = \array_sum($value);
        };
    }
}