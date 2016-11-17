<?php

namespace DynamicFormBundle\Entity\Value;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @package DynamicFormBundle\Entity\Value
 */
class TextValue extends BaseValue
{
    /**
     * @var string
     *
     * @ORM\Column(name="text_value", type="text")
     */
    private $textContent;

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->textContent;
    }

    /**
     * @param string $content
     */
    public function setContent($content)
    {
        $this->textContent = $content;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->textContent;
    }
}
