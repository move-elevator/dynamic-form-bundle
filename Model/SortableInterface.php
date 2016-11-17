<?php

namespace DynamicFormBundle\Model;

/**
 * @package DynamicFormBundle\Model
 */
interface SortableInterface
{
    /**
     * @return integer
     */
    public function getPosition();
}