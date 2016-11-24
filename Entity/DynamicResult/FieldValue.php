<?php

namespace DynamicFormBundle\Entity\DynamicResult;

use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicResult;
use DynamicFormBundle\Model\FieldValue as BaseModel;
use DynamicFormBundle\Entity\DynamicResult\ResultValue\BaseValue;

/**
 * @ORM\Entity
 * @ORM\Table(name="dynamic_form_field_value")
 *
 * @package DynamicFormBundle\Entity
 */
class FieldValue extends BaseModel
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
     * @var FormField
     *
     * @ORM\ManyToOne(targetEntity="DynamicFormBundle\Entity\DynamicForm\FormField", fetch="EAGER")
     * @ORM\JoinColumn(name="form_field_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    private $formField;

    /**
     * @var BaseValue
     *
     * @ORM\OneToOne(targetEntity="DynamicFormBundle\Entity\DynamicResult\ResultValue\BaseValue", mappedBy="field", cascade={"persist", "remove"})
     */
    private $value;

    /**
     * @var DynamicResult
     *
     * @ORM\ManyToOne(targetEntity="DynamicFormBundle\Entity\DynamicResult", inversedBy="fieldValues")
     * @ORM\JoinColumn(name="result_id", referencedColumnName="id", nullable=false)
     */
    private $result;

    /**
     * @param FormField $formField
     */
    public function __construct(FormField $formField = null)
    {
        $this->formField = $formField;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param FormField $formField
     *
     * @return FieldValue
     */
    public function setFormField(FormField $formField)
    {
        $this->formField = $formField;

        return $this;
    }

    /**
     * @return FormField
     */
    public function getFormField()
    {
        return $this->formField;
    }

    /**
     * @param BaseValue $value
     *
     * @return FieldValue
     */
    public function setValue(BaseValue $value = null)
    {
        $value->setField($this);
        $this->value = $value;

        return $this;
    }

    /**
     * @return BaseValue
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return DynamicResult
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param DynamicResult $result
     */
    public function setResult(DynamicResult $result)
    {
        $this->result = $result;
    }
}
