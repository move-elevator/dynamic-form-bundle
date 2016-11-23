<?php

namespace DynamicFormBundle\Entity\DynamicForm\ConfigValue;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_option_boolean_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class BooleanValue extends BaseValue
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="boolean_content", type="boolean")
     */
    private $booleanContent;

    /**
     * @return boolean
     */
    public function getContent()
    {
        return $this->booleanContent;
    }

    /**
     * @param boolean $content
     */
    public function setContent($content)
    {
        $this->booleanContent = $content;
    }
}
