<?php

namespace DynamicFormBundle\Entity\DynamicResult\ResultValue;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_result_float_value")
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
