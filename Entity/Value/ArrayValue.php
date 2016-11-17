<?php

namespace DynamicFormBundle\Entity\Value;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @package DynamicFormBundle\Entity\Value
 */
class ArrayValue extends BaseValue
{
    /**
     * @var array
     *
     * @ORM\Column(name="array_content", type="json_array")
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
