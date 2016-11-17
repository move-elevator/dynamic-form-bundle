<?php

namespace DynamicFormBundle\Entity\Value;

use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity
 *
 * @package DynamicFormBundle\Entity\Value
 */
class ObjectValue extends BaseValue
{
    /**
     * @var AbstractEntity
     *
     * @ORM\OneToOne(targetEntity="DynamicFormBundle\Entity\AbstractEntity", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="entity_reference", referencedColumnName="id")
     */
    private $entityContent;

    /**
     * @return object
     */
    public function getContent()
    {
        return $this->entityContent;
    }

    /**
     * @param AbstractEntity $content
     */
    public function setContent(AbstractEntity $content = null)
    {
        $this->entityContent = $content;
    }
}
