<?php

namespace DynamicFormBundle\Entity\Value;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
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
