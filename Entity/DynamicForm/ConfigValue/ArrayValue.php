<?php

namespace DynamicFormBundle\Entity\DynamicForm\ConfigValue;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_option_array_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class ArrayValue extends BaseValue
{
    /**
     * @var array
     *
     * @ORM\Column(name="array_content", type="json_array", nullable=true)
     */
    private $arrayContent;

    /**
     * @return array
     */
    public function getContent()
    {
        return $this->arrayContent;
    }

    /**
     * @param array $content
     */
    public function setContent(array $content)
    {
        $this->arrayContent = $content;
    }
}
