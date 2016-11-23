<?php

namespace DynamicFormBundle\Entity\DynamicForm\ConfigValue;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_option_float_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class FloatValue extends BaseValue
{
    /**
     * @var float
     *
     * @ORM\Column(name="float_content", type="float", nullable=true)
     */
    private $floatContent;

    /**
     * @return float
     */
    public function getContent()
    {
        return $this->floatContent;
    }

    /**
     * @param float $content
     */
    public function setContent($content)
    {
        $this->floatContent = $content;
    }
}
