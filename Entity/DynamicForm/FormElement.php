<?php

namespace DynamicFormBundle\Entity\DynamicForm;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Model\SortableInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="dynamic_form_element")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 *
 * @package DynamicFormBundle\Entity
 */
abstract class FormElement implements SortableInterface
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
     * @ORM\Column(type="text")
     */
    protected $text;

    /**
     * @var Collection|DynamicForm[]
     *
     * @ORM\ManyToMany(targetEntity="DynamicFormBundle\Entity\DynamicForm", inversedBy="elements")
     * @ORM\JoinTable(name="dynamic_form_to_element")
     */
    protected $forms;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     */
    public function __construct()
    {
        $this->forms = new ArrayCollection();
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
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param string $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param DynamicForm $form
     *
     * @return FormElement
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
    public function getForm()
    {
        return $this->forms;
    }

    /**
     * @param integer $position
     *
     * @return FormElement
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * @return integer
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @return string
     */
    abstract public function getElementType();

    /**
     * @return string
     */
    abstract public function getAnchor();
}
