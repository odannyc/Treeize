<?php
namespace Treeize;

/**
 * @author Danny Carrillo <odannycx@gmail.com>
 * @package Treeize
 */

/**
 * Used to recurse the tree
 */
class Recurse
{
    /**
     * @param $object
     *
     * @return array
     */
    public static function this($object)
    {
        return self::recurse(
            $object->tree,
            $object->parentKey,
            $object->indexKey,
            $object->parentId,
            $object->childrenKey
        );
    }

    /**
     * Recurse constructor.
     *
     * @param $tree
     * @param $parentKey
     * @param $indexKey
     * @param int $parentId
     * @param string $childrenKey
     *
     * @return array $finalTree
     */
    public static function recurse($tree, $parentKey, $indexKey, $parentId = 0, $childrenKey = 'children')
    {
        $finalTree = [];

        foreach ($tree as $value) {
            if ($value[$parentKey] == $parentId) {
                $children = self::recurse($tree, $parentKey, $indexKey, $value[$indexKey], $childrenKey);
                if ($children) {
                    $value[$childrenKey] = $children;
                }
                $finalTree[] = $value;
            }
        }

        return $finalTree;
    }
}
