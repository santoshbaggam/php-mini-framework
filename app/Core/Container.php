<?php

namespace App\Core;

use ArrayAccess;

class Container implements ArrayAccess
{
    protected $items = [];

    protected $cache = [];

    public function __construct(array $items = [])
    {
        foreach ($items as $key => $item) {
            $this->offsetSet($key, $item);
        }
    }

    public function offsetSet($offset, $value)
    {
        $this->items[$offset] = $value;
    }

    public function offsetGet($offset)
    {
        if ( ! $this->has($offset)) {
            return null;
        }

        if ( isset($this->cache[$offset]) ) {
            return $this->cache[$offset];
        }

        $item = call_user_func($this->items[$offset], $this); // similar to: $item = $this->items[$offset]($this);

        $this->cache[$offset] = $item;

        return $item;
    }

    public function offsetUnset($offset)
    {
        if ($this->has($offset)) {
            unset($this->items[$offset]);
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->items[$offset]);
    }

    public function has($offset)
    {
        return $this->offsetExists($offset);
    }

    public function __get($property)
    {
        return $this->offsetGet($property);
    }
}
