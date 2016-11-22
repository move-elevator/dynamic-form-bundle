<?php

namespace DynamicFormBundle\Tests\Functional\Form\Type;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Entity\DynamicForm\FormElement\FormHeadline;
use DynamicFormBundle\Entity\DynamicResult;
use DynamicFormBundle\Entity\Value\FileValue;
use DynamicFormBundle\Form\Type\DynamicFormType;
use DynamicFormBundle\Tests\Utility\WebTestCase;
use Symfony\Component\Form\Form;

/**
 * @package DynamicFormBundle\Tests\Functional\Form\Type
 */
class DynamicFormTypeTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->createDatabase();

        $this->loadAliceFixtures([
            $this->getAliceFixturePath('Test/dynamic_form.yml')
        ]);
    }

    public function testCreateDynamicFormType()
    {
        $dynamicForm = $this->getEntityManager()->find(DynamicForm::class, 1);

        $form = $this
            ->getContainer()
            ->get('form.factory')
            ->create(DynamicFormType::class, null, ['dynamic_form' => $dynamicForm]);

        $this->assertInstanceOf(Form::class, $form);
        $this->assertArrayHasKey('name', $form);
        $this->assertArrayHasKey('description', $form);
        $this->assertArrayHasKey('visit', $form);
        $this->assertArrayHasKey('start', $form);
        $this->assertArrayHasKey('gender_radio', $form);
        $this->assertArrayHasKey('gender_check', $form);
        $this->assertArrayHasKey('gender_select', $form);
    }

    public function testCreateViewCreateAnchorLinks()
    {
        $dynamicForm = $this->getEntityManager()->find(DynamicForm::class, 1);

        $formView = $this
            ->getContainer()
            ->get('form.factory')
            ->create(DynamicFormType::class, null, ['dynamic_form' => $dynamicForm])
            ->createView();

        /** @var FormHeadline[] $anchors */
        $anchors = $formView->vars['anchor_list'];

        $this->assertCount(2, $anchors);

        $this->assertInstanceOf(FormHeadline::class, $anchors[0]);
        $this->assertInstanceOf(FormHeadline::class, $anchors[1]);

        $this->assertEquals('Headline', $anchors[0]->getText());
    }

    public function testSubmitFormCreateDynamicResult()
    {
        $dynamicForm = $this->getEntityManager()->find(DynamicForm::class, 1);

        $form = $this
            ->getContainer()
            ->get('form.factory')
            ->create(DynamicFormType::class, null, ['dynamic_form' => $dynamicForm]);

        $form->submit([
            'name' => 'test',
            'description' => 'test description',
            'start' => [
                'day' => 16,
                'month' => 11,
                'year' => 2016
            ],
            'gender_select' => 'm',
            'gender_radio' => 'f',
            'gender_check' => ['f', 'm'],
        ]);

        /** @var DynamicResult $result */
        $result = $form->getData();

        $this->assertInstanceOf(DynamicResult::class, $result);

        $this->assertTrue($result->hasFieldValue('name'));
        $this->assertEquals('test', $result->getFieldValueContent('name'));

        $this->assertTrue($result->hasFieldValue('description'));
        $this->assertEquals('test description', $result->getFieldValueContent('description'));

        $this->assertTrue($result->hasFieldValue('start'));
        $this->assertInstanceOf(\DateTime::class, $result->getFieldValueContent('start'));
        $this->assertEquals('16.11.2016', $result->getFieldValueContent('start')->format('d.m.Y'));

        $this->assertTrue($result->hasFieldValue('gender_select'));
        $this->assertEquals('m', $result->getFieldValueContent('gender_select'));

        $this->assertTrue($result->hasFieldValue('gender_radio'));
        $this->assertEquals('f', $result->getFieldValueContent('gender_radio'));

        $this->assertTrue($result->hasFieldValue('gender_check'));
        $this->assertEquals(['m', 'f'], $result->getFieldValueContent('gender_check'));

        $this->assertTrue($result->hasFieldValue('visit'));
        $this->assertInstanceOf(FileValue::class, $result->getFieldValue('visit')->getValue());
    }
}