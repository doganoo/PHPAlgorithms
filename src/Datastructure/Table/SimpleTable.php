<?php


namespace doganoo\PHPAlgorithms\Datastructure\Table;


use doganoo\PHPAlgorithms\Common\Abstracts\AbstractTable;

class SimpleTable extends AbstractTable {


    /**
     * @param $key
     * @param $value
     */
    public function put($key, $value): void {
        $this->table[$key] = $value;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key) {
        return $this->table[$key] ?? null;
    }
}