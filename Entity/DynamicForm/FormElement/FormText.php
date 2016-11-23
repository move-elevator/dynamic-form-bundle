<?php

namespace DynamicFormBundle\Entity\DynamicForm\FormElement;

use DynamicFormBundle\Entity\DynamicForm\FormElement;
use DynamicFormBundle\Statics\FormElements;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dynamic_form_element_text")
 *
 * @package DynamicFormBundle\Entity
 */
class FormText extends FormElement
{

    /**
     * @return string
     */
    public function getElementType()
    {
        return FormElements::TEXT;
    }

    /**
     * @return string
     */
    public function getAnchor()
    {
        return sprintf('%s_%s', strtolower(preg_replace('/\B([A-Z])/', '_$1', $this->getElementType())), $this->getId());
    }
}
