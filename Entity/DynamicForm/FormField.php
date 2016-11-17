<?php

namespace DynamicFormBundle\Entity\DynamicForm;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use DynamicFormBundle\Entity\DynamicForm\FormField\FormType;
use DynamicFormBundle\Model\SortableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dynamic_form_field")
 *
 * @package DynamicFormBundle\Entity
 */
class FormField implements SortableInterface
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
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @var DynamicForm
     *
     * @ORM\ManyToOne(targetEntity="DynamicFormBundle\Entity\DynamicForm", inversedBy="fields")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id", nullable=false)
     */
    private $form;

    /**
     * @var Collection|OptionValue[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue")
     * @ORM\JoinTable(name="dynamic_form_field_to_option_value",
     *      joinColumns={@ORM\JoinColumn(name="field_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="option_value_id", referencedColumnName="id")}
     *      )
     */
    private $optionValues;

    /**
     * @var FormType
     *
     * @ORM\ManyToOne(targetEntity="DynamicFormBundle\Entity\DynamicForm\FormField\FormType")
     * @ORM\JoinColumn(name="type_id", referencedColumnName="id", nullable=false)
     */
    private $formType;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @param string   $name
     * @param FormType $formType
     */
    public function __construct($name = null, FormType $formType = null)
    {
        $this->optionValues = new ArrayCollection();
        $this->name = $name;
        $this->formType = $formType;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param DynamicForm $form
     *
     * @return FormField
     */
    public function setForm(DynamicForm $form)
    {
        $this->form = $form;

        return $this;
    }

    /**
     * @return DynamicForm
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param FormType $formType
     *
     * @return FormField
     */
    public function setFormType(FormType $formType)
    {
        $this->formType = $formType;

        return $this;
    }

    /**
     * @return FormType
     */
    public function getFormType()
    {
        return $this->formType;
    }

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return FormField
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @param OptionValue $optionValue
     *
     * @return FormField
     */
    public function addOptionValue(OptionValue $optionValue)
    {
        $this->optionValues[] = $optionValue;

        return $this;
    }

    /**
     * @param OptionValue $optionValue
     */
    public function removeOptionValue(OptionValue $optionValue)
    {
        $this->optionValues->removeElement($optionValue);
    }

    /**
     * @return Collection|OptionValue[]
     */
    public function getOptionValues()
    {
        return $this->optionValues;
    }

    /**
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param integer $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }
}
