<?php

namespace Kata\Core;

interface Collection extends \Iterator, \Countable
{
    public function setItemByKey($an_item_key, $an_item);

    public function unsetItemByKey($an_item_key);

    public function addItem($an_item);

    /**
     * @return array
     */
    public function itemsIndexes();

    public function itemWithKey($an_item_key);

    public function allItems();

    public function hasItemWithKey($an_item_key);

    public function union(Collection $a_collection);

    public function current();

    public function next();

    public function key();

    public function valid();

    public function rewind();

    public function count();
}
