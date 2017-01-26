<?php
namespace elnebuloso\Flex;

use ArrayAccess;
use Countable;
use Iterator;

/**
 * Class Collection
 *
 * @author Jeff Tunessen <jeff.tunessen@gmail.com>
 */
class Collection implements Iterator, ArrayAccess, Countable, HasToArray, HasToJson
{
    /**
     * @var array
     */
    private $elements = [];

    /**
     * @var int
     */
    private $totalCount;

    /**
     * @param array $elements
     * @param int $totalCount
     */
    public function __construct(array $elements = [], $totalCount = null)
    {
        $this->elements = $elements;
        $this->totalCount = $totalCount;
    }

    /**
     * @return array
     */
    public function getElements()
    {
        return $this->elements;
    }

    /**
     * @param array $elements
     */
    public function setElements(array $elements)
    {
        $this->elements = $elements;
    }

    /**
     * @param mixed $element
     * @param mixed $id
     */
    public function addElement($element, $id = null)
    {
        if ($id !== null) {
            $this->elements[$id] = $element;
        } else {
            $this->elements[] = $element;
        }
    }

    /**
     * @param mixed $id
     * @return null
     */
    public function getElement($id)
    {
        if (array_key_exists($id, $this->elements)) {
            return $this->elements[$id];
        }

        return null;
    }

    /**
     * @param mixed $id
     */
    public function removeElement($id)
    {
        if (array_key_exists($id, $this->elements)) {
            unset($this->elements[$id]);
        }
    }

    /**
     * @return int
     */
    public function getTotalCount()
    {
        return $this->totalCount;
    }

    /**
     * @param int $totalCount
     */
    public function setTotalCount($totalCount)
    {
        $this->totalCount = $totalCount;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $elements = [];

        foreach ($this->elements as $element) {
            if (is_object($element)) {
                if ($element instanceof HasToArray) {
                    $elements[] = $element->toArray();
                }
            } else {
                $elements[] = $element;
            }
        }

        return $elements;
    }

    /**
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->toArray());
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->elements);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return next($this->elements);
    }

    /**
     * @return void
     */
    public function rewind()
    {
        reset($this->elements);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return $this->current() !== false;
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->elements);
    }

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists($offset)
    {
        return isset($this->elements[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->elements[$offset]) ? $this->elements[$offset] : null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        if ($offset === null) {
            $this->elements[] = $value;
        } else {
            $this->elements[$offset] = $value;
        }
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        if (array_key_exists($offset, $this->elements)) {
            unset($this->elements[$offset]);
        }
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->elements);
    }
}
