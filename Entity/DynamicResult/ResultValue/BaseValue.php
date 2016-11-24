<?php

namespace DynamicFormBundle\Entity\DynamicResult\ResultValue;

use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicResult\FieldValue;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_result_value")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 *
 * @package DynamicFormBundle\Entity\Value
 */
abstract class BaseValue
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var FieldValue
     *
     * @ORM\OneToOne(targetEntity="DynamicFormBundle\Entity\DynamicResult\FieldValue", inversedBy="value")
     * @ORM\JoinColumn(name="field_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $field;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return FieldValue
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param FieldValue $field
     */
    public function setField(FieldValue $field)
    {
        $this->field = $field;
    }

    /**
     * @return mixed
     */
    abstract public function getContent();
}
