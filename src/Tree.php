<?php
namespace Treeize;

/**
 * @author Danny Carrillo <odannycx@gmail.com>
 * @package Treeize
 */

/**
 * Used to store the tree and manipulate it.
 */
class Tree
{
    /**
     * Should be an array, usually single level.
     *
     * @array
     */
    public $tree;

    /**
     * This is the parent key we base our parsing from.
     *
     * @string
     */
    public $parentKey = 'parent_id';

    /**
     * The index in which the parent is based off of
     *
     * @string
     */
    public $indexKey = 'id';

    /**
     * The initial parent ID
     *
     * @string|@int
     */
    public $parentId = 0;

    /**
     * This should be set to what the children key should say.
     *
     * @string
     */
    public $childrenKey = 'children';

    /**
     * A callback function that gets applied to every item in the array.
     * @var null
     */
    public $callback = null;

    /**
     * Tree constructor.
     *
     * @param array $tree
     *
     * @throws \Exception
     */
    public function __construct($tree)
    {
        // Make sure the $tree is array
        if (!is_array($tree)) {
            throw new \Exception('The tree parameter has to be an array.');
        }

        $this->tree = $tree;

        return $this;
    }

    /**
     * @param $parent
     * @return $this
     */
    public function parentKey($parent)
    {
        $this->parentKey = $parent;

        return $this;
    }

    /**
     * @param $index
     * @return $this
     */
    public function indexKey($index)
    {
        $this->indexKey = $index;

        return $this;
    }

    /**
     * @param $parentId
     * @return $this
     */
    public function parentId($parentId)
    {
        $this->parentId = $parentId;

        return $this;
    }

    /**
     * @param $childrenKey
     * @return $this
     */
    public function childrenKey($childrenKey)
    {
        $this->childrenKey = $childrenKey;

        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function parse(callable $callback = null)
    {
        // If parent_id doesn't exist, find it
        if (empty($this->parentId)) {
            $this->parentId = Utils::findParentId($this->tree, $this->parentKey, $this->indexKey);
        }

        $this->callback = $callback;
        $this->tree = Recurse::this($this);

        return $this;
    }

    /**
     * @return array
     */
    public function get()
    {
        return $this->tree;
    }
}
