<?php

namespace DynamicFormBundle\Entity\DynamicResult\ResultValue;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DynamicFormBundle\Entity\DynamicForm\Choice;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_result_choice_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class ChoiceValue extends BaseValue
{
    /**
     * @var Choice
     *
     * @ORM\ManyToOne(targetEntity="DynamicFormBundle\Entity\DynamicForm\Choice", cascade={"persist", "remove"}, fetch="EAGER")")
     * @ORM\JoinColumn(name="choice_id", referencedColumnName="id")

     */
    private $choice;

    /**
     * @return Choice
     */
    public function getContent()
    {
        return $this->choice;
    }

    /**
     * @param Choice $content
     */
    public function setContent(Choice $content = null)
    {
        $this->choice = $content;
    }
}
