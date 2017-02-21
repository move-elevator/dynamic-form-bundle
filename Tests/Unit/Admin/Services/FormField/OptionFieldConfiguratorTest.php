<?php

namespace DynamicFormBundle\Tests\Unit\Admin\Services\FormField;

use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\DisabledConfiguration;
use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\PlaceholderConfiguration;
use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\Registry;
use DynamicFormBundle\Admin\Services\FormField\Option\Configuration\RequiredConfiguration;
use DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder\ChoiceFieldBuilder;
use DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder\CollectionFieldBuilder;
use DynamicFormBundle\Admin\Services\FormField\OptionFieldBuilder\SingleFieldBuilder;
use DynamicFormBundle\Admin\Services\FormField\OptionFieldConfigurator;
use DynamicFormBundle\Entity\DynamicForm\FormField;
use DynamicFormBundle\Entity\DynamicForm\FormField\OptionValue;
use DynamicFormBundle\Services\FormField\OptionFilter;
use DynamicFormBundle\Statics\FormFieldOptions\BaseOptions;
use DynamicFormBundle\Statics\SymfonyFieldOptions;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormInterface;

/**
 * @package DynamicFormBundle\Tests\Unit\Admin\Services\FormField
 */
class OptionFieldConfiguratorTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var OptionFieldConfigurator
     */
    private $configurator;

    protected function setUp()
    {
        $registry = new Registry();
        $registry->addConfiguration(new RequiredConfiguration());
        $registry->addConfiguration(new DisabledConfiguration());
        $registry->addConfiguration(new PlaceholderConfiguration());

        $filter = new OptionFilter(['disabled']);

        $this->configurator = new OptionFieldConfigurator($registry, $filter);
        $this->configurator->addOptionFieldBuilder(new SingleFieldBuilder());
        $this->configurator->addOptionFieldBuilder(new CollectionFieldBuilder());
        $this->configurator->addOptionFieldBuilder(new ChoiceFieldBuilder());
    }

    public function testConfigFieldsFilterAndAddOptionFormFields()
    {
        $formField = new FormField();
        $formField->addOptionValue(new OptionValue(BaseOptions::DISABLED, SymfonyFieldOptions::DISABLED));
        $formField->addOptionValue(new OptionValue(BaseOptions::REQUIRED, SymfonyFieldOptions::REQUIRED));
        $formField->addOptionValue(new OptionValue(BaseOptions::PLACEHOLDER, SymfonyFieldOptions::ATTR_PLACEHOLDER));

        $this->configurator->configFields($this->getFormMock(2), $formField);
    }

    /**
     * @param int $addCalls
     *
     * @return FormInterface
     */
    private function getFormMock($addCalls = 0)
    {
        $form = $this
            ->getMockBuilder(FormInterface::class)
            ->disableOriginalConstructor()
            ->getMock();

        $form
            ->expects($this->exactly($addCalls))
            ->method('add')
            ->withConsecutive(
                [BaseOptions::REQUIRED, CheckboxType::class, ['mapped' => false, 'required' => false]],
                [BaseOptions::PLACEHOLDER, TextType::class, ['mapped' => false, 'required' => false]]
            );

        return $form;
    }
}