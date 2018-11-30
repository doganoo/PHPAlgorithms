<?php

namespace MapReduce;

use doganoo\PHPAlgorithms\Common\Interfaces\MapReduce\IMapper;
use doganoo\PHPAlgorithms\Common\Util\Comparator;

class Mapper implements IMapper {

    private $ccallable = null;

    /**
     * returns a callable that maps $value and $key in $reduced
     *
     * @param $key
     * @param $value
     * @param array $map
     * @return Callable
     */
    public function getMapper($key, $value, array &$map): Callable {
        $this->ccallable = function ($key, $value, &$map) use (&$left, &$right) {
            echo $value;
            if (Comparator::lessThan($value, 5)) {
                $left[] = $value;
            } else {
                $right[] = $value;
            }

            $map["left"] = $left;
            $map["right"] = $right;
        };
        $left = $right = [];
        return function ($key, $value, &$map) use (&$left, &$right) {
            echo $value;
            if (Comparator::lessThan($value, 5)) {
                $left[] = $value;
            } else {
                $right[] = $value;
            }

            $map["left"] = $left;
            $map["right"] = $right;
        };
    }

    public function run(): void {
        $this->ccallable();
    }

}