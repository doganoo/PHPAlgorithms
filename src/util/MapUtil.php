<?php


namespace doganoo\PHPAlgorithms\Util;


class MapUtil {

    private function __construct() {
    }

    /**
     * Check if a string is serialized
     *
     * see: https://stackoverflow.com/a/4994515
     *
     * @param string $string
     * @return bool
     */
    public static function isSerialized(string $string) {
        return (@unserialize($string) !== false);
    }
}