<?php


use doganoo\PHPAlgorithms\Datastructure\Cache\LRUCache;

class LRUCacheTest extends \PHPUnit\Framework\TestCase {

    public function testCache() {
        $cache = new LRUCache();
        $cache->put("a", 1);
        $cache->put("b", 2);
        $value = $cache->get("a");
        $this->assertTrue($value === 1);
        $last = $cache->last();
        $this->assertTrue($last === "a");
        $deleted = $cache->delete("a");
        $this->assertTrue($deleted === true);
        $last = $cache->last();
        $this->assertTrue($last === "b");
    }

    public function testCacheWithSize() {
        $cache = new LRUCache(2);
        $cache->put("a", 1);
        $cache->put("b", 2);
        $this->assertTrue($cache->last() === "b");
        $cache->put("c", 3);
        $this->assertTrue($cache->get("a") === null);
        $value = $cache->get("b");
        $this->assertTrue($value === 2);
        $cache->put("d", 4);
        $this->assertTrue($cache->get("c") === null);
    }

}