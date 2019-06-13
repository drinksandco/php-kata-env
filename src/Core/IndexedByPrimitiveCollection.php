<?php

namespace Kata\Core;

abstract class IndexedByPrimitiveCollection implements Collection
{
    /**
     * @var array
     */
    protected $all_items;

    /**
     * @param array $some_items
     */
    public function __construct(array $some_items = [])
    {
        $this->all_items = [];

        foreach ($some_items as $an_item) {
            $this->addItem($an_item);
        }
    }

    private function validateItemClass($an_item)
    {
        $valid_class = $this->collectionItemsClassName();

        if (!$an_item instanceof $valid_class) {
            throw new \InvalidArgumentException(
                "You must specify an array of instances of '$valid_class' instead of '" . \get_class($an_item) . "' while creating a '" . static::class . "'."
            );
        }
    }

    private function validateCollectionClass(Collection $a_collection)
    {
        $a_collection_class    = \get_class($a_collection);
        $this_collection_class = static::class;

        if ($a_collection_class != $this_collection_class) {
            throw new \InvalidArgumentException(
                "You can't operate with different kind of collections. You have a '$this_collection_class' and you're specifying a '$a_collection_class'."
            );
        }
    }

    public function implode($glue = ',')
    {
        return \implode($glue, $this->allItems());
    }

    // Methods to set, unset and get items.

    final public function setItemByKey($an_item_key, $an_item)
    {
        $this->validateItemClass($an_item);

        $this->all_items[$an_item_key] = $an_item;
    }

    final public function unsetItemByKey($an_item_key)
    {
        if ($this->hasItemWithKey($an_item_key)) {
            unset($this->all_items[$an_item_key]);
        }
    }

    final public function addItem($an_item)
    {
        $this->validateItemClass($an_item);

        $item_key = $this->nextItemKey($an_item);

        $this->all_items[$item_key] = $an_item;
    }

    final public function itemsIndexes()
    {
        return \array_keys($this->all_items);
    }

    final public function itemWithKey($an_item_key)
    {
        if (!$this->hasItemWithKey($an_item_key)) {
            $collection_class = $this->collectionItemsClassName();

            throw new \OutOfBoundsException("You're trying to get a non existent item with the key $an_item_key from a $collection_class collection.");
        }

        return $this->all_items[$an_item_key];
    }

    final public function allItems()
    {
        return $this->all_items;
    }

    final public function hasItemWithKey($an_item_key)
    {
        return \array_key_exists($an_item_key, $this->all_items);
    }

    // Set theory methods.

    public function union(Collection $a_collection)
    {
        $this->validateCollectionClass($a_collection);

        $other_items = $a_collection->allItems();

        $this->all_items = $other_items + $this->allItems();
    }

    // Iterator methods.

    final public function current()
    {
        return \current($this->all_items);
    }

    final public function next()
    {
        \next($this->all_items);
    }

    final public function key()
    {
        return \key($this->all_items);
    }

    final public function valid()
    {
        return \current($this->all_items);
    }

    final public function rewind()
    {
        \reset($this->all_items);
    }

    final public function count()
    {
        return \count($this->all_items);
    }

    // Methods to override.

    /**
     * @return string The namespace of the class of each item contained in the {@see $all_items} array. Use the '::class' keyword.
     */
    abstract protected function collectionItemsClassName();

    /**
     * You can override this method and it'll be called each time you add an item through the {@see addItem} method.
     * It returns the next array index by default.
     *
     * @param mixed $an_item Item of the {@see collectionItemsClassName} class.
     *
     * @return integer|string the collection key to insert the {@see $an_item}
     */
    abstract protected function nextItemKey($an_item);
}
