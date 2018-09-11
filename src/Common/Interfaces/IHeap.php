<?php


namespace doganoo\PHPAlgorithms\Common\Interfaces;


interface IHeap extends IComparable, \JsonSerializable {

    /**
     * clears the heap
     *
     * @return bool
     */
    public function clear(): bool;

    /**
     * returns the number of elements in the heap
     *
     * @return int
     */
    public function length(): int;

    /**
     * inserts a new element to the heap (currently integers only)
     *
     * @param int $element
     */
    public function insert(int $element): void;

    /**
     * returns the parent position of the current position
     *
     * @param int $position
     * @return int
     */
    public function getParentPosition(int $position): int;

    /**
     * swaps elements current and parent
     *
     * @param int $current
     * @param int $parent
     */
    public function swap(int $current, int $parent): void;

    /**
     * determines whether an element is in the heap or not
     *
     * @param int $element
     * @return bool
     */
    public function inHeap(int $element): bool;

}