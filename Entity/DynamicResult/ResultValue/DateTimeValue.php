<?php

namespace DynamicFormBundle\Entity\DynamicResult\ResultValue;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 *
 * @ORM\Table(name="dynamic_form_result_datetime_value")
 *
 * @package DynamicFormBundle\Entity\Value
 */
class DateTimeValue extends BaseValue
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_time_content", type="datetime")
     */
    private $dateTimeContent;

    /**
     */
    public function __construct()
    {
        $this->dateTimeContent = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getContent()
    {
        return $this->dateTimeContent;
    }

    /**
     * @param \DateTime $content
     */
    public function setContent(\DateTime $content = null)
    {
        $this->dateTimeContent = $content;
    }
}
