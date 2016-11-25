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
 * @ORM\EntityListeners({
 *     "DynamicFormBundle\EventListener\DynamicFormListener"
 * })
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
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=true)
     */
    protected $name;

    /**
     * @var Collection|FormField[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\FormField", mappedBy="forms", cascade={"persist", "remove"})
     */
    protected $fields;

    /**
     * @var Collection|FormField[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm\FormElement", mappedBy="forms", cascade={"persist", "remove"})
     */
    protected $elements;

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
        $field->addForm($this);
        $this->fields[$field->getName()] = $field;

        return $this;
    }

    /**
     * @param FormField $field
     */
    public function removeField(FormField $field)
    {
        $field->removeForm($this);
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
        $element->addForm($this);
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
