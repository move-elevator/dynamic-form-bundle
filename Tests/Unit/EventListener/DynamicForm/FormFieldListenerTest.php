<?php

namespace DynamicFormBundle\EventListener\DynamicForm;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Event\LifecycleEventArgs;
use DynamicFormBundle\Entity\DynamicForm\FormField;

/**
 * @package DynamicFormBundle\EventListener\DynamicForm
 */
class FormFieldListenerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FormFieldListener
     */
    private $listener;

    protected function setUp()
    {
        $this->listener = new FormFieldListener(new Slugify());
    }

    public function testCreateAndSetKeyForFormField()
    {
        $formField = new FormField('Form Field');
        $event = $this
            ->getMockBuilder(LifecycleEventArgs::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->listener->setKey($formField, $event);

        $this->assertEquals('form-field', $formField->getKey());
    }
}
