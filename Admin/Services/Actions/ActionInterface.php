<?php

namespace DynamicFormBundle\Admin\Services\Actions;

/**
 * @package DynamicFormBundle\Admin\Services\Actions
 */
interface ActionInterface
{
    /**
     * @param object $object
     *
     * @return boolean
     */
    public function action($object);
}
