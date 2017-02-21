<?php

namespace DynamicFormBundle\Entity\DynamicForm;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Model\SortableInterface;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     *
     * @Assert\NotBlank()
     */
    protected $text;

    /**
     * @var DynamicForm
     *
     * @ORM\ManyToOne(targetEntity="DynamicFormBundle\Entity\DynamicForm", inversedBy="elements")
     * @ORM\JoinColumn(name="form_id", referencedColumnName="id")
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
