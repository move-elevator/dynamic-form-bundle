<?php

namespace DynamicFormBundle\Services\FormType;

/**
 * @package DynamicFormBundle\Services\FormType
 */
interface ChoiceConfigurationInterface extends ConfigurationInterface
{
    /**
     * @return \Closure
     */
    public function getChoiceLabelFunction();

    /**
     * @return \Closure
     */
    public function getChoiceValueFunction();
}