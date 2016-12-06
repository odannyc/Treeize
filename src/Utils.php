<?php
namespace Treeize;

/**
 * @author Danny Carrillo <odannycx@gmail.com>
 * @package Treeize
 */

/**
 * Some tree utils
 */
class Utils
{
    /**
     * Takes in a tree and outputs the parent ID.
     *
     * @param $tree
     * @param $parentKey
     * @param $indexKey
     *
     * @return int
     */
    public static function findParentId($tree, $parentKey, $indexKey)
    {
        $parentId = 0;
        foreach ($tree as $branch) {
            if (array_search($branch[$parentKey], array_column($tree, $indexKey))) {
                $parentId = $branch[$parentKey];
            }
        }

        return $parentId;
    }
}
