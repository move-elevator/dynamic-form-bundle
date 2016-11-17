<?php

namespace DynamicFormBundle\Twig;

use DynamicFormBundle\Entity\DynamicForm\FormElement;

/**
 * @package DynamicFormBundle\Twig
 */
class FormElementExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getTests()
    {
        return [
            new \Twig_SimpleTest('FormElement', [$this, 'isFormElement']),
        ];
    }

    /**
     * @param mixed $formText
     *
     * @return bool
     */
    public function isFormElement($formText)
    {
        return $formText instanceOf FormElement;
    }
}