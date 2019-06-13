<?php

namespace Kata\Core;

abstract class SequentialCollection extends IndexedByPrimitiveCollection
{
    final protected function nextItemKey($an_item)
    {
        return count($this->allItems());
    }
}
