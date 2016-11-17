<?php

namespace DynamicFormBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicResult\FieldValue;
use DynamicFormBundle\Model\DynamicResult as BaseModel;

/**
 * @ORM\Entity
 * @ORM\Table(name="dynamic_form_result")
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 *
 * @package DynamicFormBundle\Entity
 */
class DynamicResult extends BaseModel
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
     * @ORM\ManyToOne(targetEntity="DynamicFormBundle\Entity\DynamicForm")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id", nullable=false)
     */
    private $form;

    /**
     * @var Collection|FieldValue[]
     *
     * @ORM\OneToMany(targetEntity="DynamicFormBundle\Entity\DynamicResult\FieldValue", mappedBy="result", cascade={"persist", "remove"}, fetch="EAGER")
     */
    private $fieldValues;

    /**
     */
    public function __construct()
    {
        $this->fieldValues = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param FieldValue $value
     *
     * @return DynamicResult
     */
    public function addFieldValue(FieldValue $value)
    {
        $value->setResult($this);

        $this->fieldValues[$value->getFormField()->getName()] = $value;

        return $this;
    }

    /**
     * Remove value
     *
     * @param FieldValue $value
     */
    public function removeFieldValue(FieldValue $value)
    {
        $this->fieldValues->removeElement($value);
    }

    /**
     * @return Collection|FieldValue[]
     */
    public function getFieldValues()
    {
        return $this->fieldValues;
    }

    /**
     * @param string $fieldName
     *
     * @return FieldValue|null
     */
    public function getFieldValue($fieldName)
    {
        return $this->fieldValues[$fieldName];
    }

    /**
     * @return DynamicForm
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param DynamicForm $form
     */
    public function setForm(DynamicForm $form)
    {
        $this->form = $form;
    }
}
