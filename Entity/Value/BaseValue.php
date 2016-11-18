<?php

namespace DynamicFormBundle\Entity\Value;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_value")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 *     "text"="DynamicFormBundle\Entity\Value\TextValue",
 *     "string"="DynamicFormBundle\Entity\Value\StringValue",
 *     "integer"="DynamicFormBundle\Entity\Value\IntegerValue",
 *     "float"="DynamicFormBundle\Entity\Value\FloatValue",
 *     "bool"="DynamicFormBundle\Entity\Value\BooleanValue",
 *     "array"="DynamicFormBundle\Entity\Value\ArrayValue",
 *     "datetime"="DynamicFormBundle\Entity\Value\DateTimeValue",
 *     "object"="DynamicFormBundle\Entity\Value\ObjectValue",
 *     "file"="DynamicFormBundle\Entity\Value\FileValue"
 * })
 *
 * @package DynamicFormBundle\Entity\Value
 */
abstract class BaseValue
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    abstract public function getContent();
}
