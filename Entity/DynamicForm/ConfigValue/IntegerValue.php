<?php

namespace DynamicFormBundle\Entity\DynamicForm\ConfigValue;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_option_integer_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class IntegerValue extends BaseValue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="integer_content", type="integer")
     */
    private $integerContent;

    /**
     * @return float
     */
    public function getContent()
    {
        return $this->integerContent;
    }

    /**
     * @param integer $content
     */
    public function setContent($content)
    {
        $this->integerContent = $content;
    }
}
