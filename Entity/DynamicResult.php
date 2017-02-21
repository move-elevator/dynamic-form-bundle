<?php

namespace DynamicFormBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicResult\FieldValue;
use DynamicFormBundle\Model\DynamicResult as BaseModel;

/**
 * @ORM\Entity
 *
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
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="DynamicFormBundle\Entity\DynamicForm", inversedBy="results")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id", nullable=false)
     */
    protected $form;

    /**
     * @var Collection|FieldValue[]
     *
     * @ORM\OneToMany(
     *     targetEntity="DynamicFormBundle\Entity\DynamicResult\FieldValue",
     *     mappedBy="result", cascade={"persist", "remove"}, fetch="EAGER"
     * )
     */
    protected $fieldValues;

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
        if (false === $this->fieldValues->contains($value)) {
            $value->setResult($this);
            $this->fieldValues[] = $value;
        }

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
        $form->addResult($this);
        $this->form = $form;
    }
}
