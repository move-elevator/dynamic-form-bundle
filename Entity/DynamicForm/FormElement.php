<?php

namespace DynamicFormBundle\Entity\DynamicForm;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\Value\BaseValue;
use DynamicFormBundle\Entity\Value\TextValue;
use DynamicFormBundle\Model\SortableInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="form_element")
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
     * @var TextValue
     *
     * @ORM\ManyToOne(targetEntity="DynamicFormBundle\Entity\Value\BaseValue")
     * @ORM\JoinColumn(name="value_id", referencedColumnName="id", nullable=false)
     */
    protected $text;

    /**
     * @var DynamicForm
     *
     * @ORM\ManyToOne(targetEntity="DynamicFormBundle\Entity\DynamicForm", inversedBy="elements")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id", nullable=false)
     */
    protected $form;

    /**
     * @var integer
     *
     * @ORM\Column(type="integer")
     */
    protected $position;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return BaseValue
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param DynamicForm $form
     *
     * @return FormElement
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
