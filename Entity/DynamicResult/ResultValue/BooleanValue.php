<?php

namespace DynamicFormBundle\Entity\DynamicResult\ResultValue;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_result_boolean_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class BooleanValue extends BaseValue
{
    /**
     * @var boolean
     *
     * @ORM\Column(name="boolean_content", type="boolean", nullable=true)
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
