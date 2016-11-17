<?php

namespace DynamicFormBundle\Entity;

use DynamicFormBundle\Entity\DynamicForm\FormElement;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Model\DynamicForm as BaseModel;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table
 * @ORM\Entity
 *
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 *
 * @package DynamicFormBundle\Entity
 */
class DynamicForm extends BaseModel
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
     * @var Collection|FormField[]
     *
     * @ORM\OneToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\FormField", mappedBy="form", cascade={"persist", "remove"})
     */
    private $fields;

    /**
     * @var Collection|FormField[]
     *
     * @ORM\OneToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\FormElement", mappedBy="form", cascade={"persist", "remove"})
     */
    private $elements;

    /**
     */
    public function __construct()
    {
        $this->fields = new ArrayCollection();
        $this->elements = new ArrayCollection();
    }

    /**
     * @return integer
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
     * @param FormField $field
     *
     * @return DynamicForm
     */
    public function addField(FormField $field)
    {
        $this->fields[$field->getName()] = $field;

        return $this;
    }

    /**
     * @param FormField $field
     */
    public function removeField(FormField $field)
    {
        $this->fields->removeElement($field);
    }

    /**
     * @return Collection|FormField[]
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * @param string $name
     *
     * @return FormField|null
     */
    public function getField($name)
    {
        return $this->fields[$name];
    }

    /**
     * Add element
     *
     * @param FormElement $element
     *
     * @return DynamicForm
     */
    public function addElement(FormElement $element)
    {
        $this->elements[] = $element;

        return $this;
    }

    /**
     * Remove element
     *
     * @param FormElement $element
     */
    public function removeElement(FormElement $element)
    {
        $this->elements->removeElement($element);
    }

    /**
     * Get elements
     *
     * @return Collection|FormElement[]
     */
    public function getElements()
    {
        return $this->elements;
    }
}
