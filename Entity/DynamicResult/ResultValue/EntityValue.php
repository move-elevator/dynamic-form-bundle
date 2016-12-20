<?php

namespace DynamicFormBundle\Entity\DynamicResult\ResultValue;

use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\AbstractEntity;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_result_entity_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class EntityValue extends BaseValue
{
    /**
     * @var AbstractEntity
     *
     * @ORM\OneToOne(targetEntity="DynamicFormBundle\Entity\AbstractEntity", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="entity_reference", referencedColumnName="id", nullable=true)
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

    public function __clone()
    {
        $this->entityContent = clone $this->entityContent;
    }
}
