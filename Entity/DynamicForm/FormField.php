<?php

namespace DynamicFormBundle\Entity\DynamicForm;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use DynamicFormBundle\Model\SortableInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="dynamic_form_field")
 *
 * @ORM\Entity
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
     * @var string
     *
     * @ORM\Column(type="string", name="field_key", unique=true)
     */
    private $key;

    /**
     * @var Collection|DynamicForm[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm", inversedBy="fields")
     * @ORM\JoinTable(name="dynamic_form_to_field")
     */
    private $forms;

    /**
     * @var Collection|OptionValue[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue", cascade={"persist", "remove"})
     * @ORM\JoinTable(name="dynamic_form_field_to_option_value",
     *      joinColumns={@ORM\JoinColumn(name="field_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="option_value_id", referencedColumnName="id")}
     *      )
     */
    private $optionValues;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $formType;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    private $position;

    /**
     * @param string $name
     * @param string $formType
     * @param string $key
     */
    public function __construct($name = null, $formType = null, $key = null)
    {
        $this->optionValues = new ArrayCollection();
        $this->forms = new ArrayCollection();
        $this->name = $name;
        $this->key = $key;
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
    public function addForm(DynamicForm $form)
    {
        $this->forms[$form->getId()] = $form;

        return $this;
    }

    /**
     * @param DynamicForm $form
     */
    public function removeForm(DynamicForm $form)
    {
        $this->forms->removeElement($form);
    }

    /**
     * @return DynamicForm[]
     */
    public function getForms()
    {
        return $this->forms;
    }

    /**
     * @param string $formType
     *
     * @return FormField
     */
    public function setFormType($formType)
    {
        $this->formType = $formType;

        return $this;
    }

    /**
     * @return string
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
        if (false === $this->optionValues->contains($optionValue)) {
            $this->optionValues[] = $optionValue;
        }

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
     * @param string $option
     *
     * @return boolean
     */
    public function hasOptionValues($option)
    {
        foreach ($this->getOptionValues() as $optionValue) {
            if ($optionValue->getName() === $option) {
                return true;
            }
        }

        return false;
    }

    /**
     * @param string $option
     *
     * @return OptionValue
     */
    public function getOptionValue($option)
    {
        foreach ($this->getOptionValues() as $optionValue) {
            if ($optionValue->getName() === $option) {
                return $optionValue;
            }
        }
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

    /**
     * @return string
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param string $key
     */
    public function setKey($key)
    {
        $this->key = $key;
    }
}
