<?php
/**
 * @author Danny Carrillo <odannycx@gmail.com>
 * @package Treeize
 */

/**
 * Used as a factory class initiate and accept requests.
 */
class Treeize
{
    public static function create($tree)
    {
        return new Tree($tree);
    }
}
