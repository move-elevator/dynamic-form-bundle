<?php

namespace DynamicFormBundle\Tests\Utility;

/**
 * @package AppBundle\Tests\Utility
 */
class IteratorWrapper implements \Iterator
{
    /**
     * @var array
     */
    private $entries;

    /**
     * @param array $entries
     */
    public function __construct(array $entries = [])
    {
        $this->entries = $entries;
    }

    /**
     * @return array
     */
    public function getIterator()
    {
        return $this->entries;
    }

    /**
     * @param string $identifier
     * @param mixed  $entry
     */
    public function addEntry($identifier, $entry)
    {
        $this->entries[$identifier] = $entry;
    }

    /**
     * @return array
     */
    public function rewind()
    {
        return reset($this->entries);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->entries);
    }

    /**
     * @return string
     */
    public function key()
    {
        return key($this->entries);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return next($this->entries);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return null !== key($this->entries);
    }
}
