<?php

namespace DynamicFormBundle\Entity\Value;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @package DynamicFormBundle\Entity\Value
 */
class FloatValue extends BaseValue
{
    /**
     * @var float
     *
     * @ORM\Column(name="float_content", type="float")
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
