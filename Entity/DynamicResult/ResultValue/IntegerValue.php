<?php

namespace DynamicFormBundle\Entity\DynamicResult\ResultValue;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_result_integer_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class IntegerValue extends BaseValue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="integer_content", type="integer", nullable=true)
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
