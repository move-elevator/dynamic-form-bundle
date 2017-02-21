<?php

namespace DynamicFormBundle\Tests\Functional\View;

use DynamicFormBundle\Entity\DynamicForm;
use DynamicFormBundle\Form\Type\DynamicFormType;
use DynamicFormBundle\Tests\Utility\WebTestCase;

/**
 * @package DynamicFormBundle\Tests\Functional\View
 */
class DynamicFormTest extends WebTestCase
{
    protected function setUp()
    {
        parent::setUp();

        $this->createDatabase();

        $this->loadAliceFixtures([
            $this->getAliceFixturePath('Test/dynamic_form.yml')
        ]);
    }

    public function testRenderDynamicFormElements()
    {
        $content = $this->createFormTemplate();

        // render FormHeadlines
        $this->assertContains('<h1 id="form_headline_2">Headline</h1>', $content);
        $this->assertContains('<h1 id="form_headline_3">Gender</h1>', $content);

        // render FormText
        $this->assertContains('<p id="text_1">Beschreibung</p>', $content);
    }

    public function testRenderDynamicFormInputs()
    {
        $content = $this->createFormTemplate();

        // render FormHeadlines
        $this->assertContains('<h1 id="form_headline_2">Headline</h1>', $content);
        $this->assertContains('<h1 id="form_headline_3">Gender</h1>', $content);

        // render FormText
        $this->assertContains('<p id="text_1">Beschreibung</p>', $content);

        // render description as textarea
        $this->assertContains('<textarea id="dynamic_form_description" name="dynamic_form[description]"></textarea>', $content);
        // render Visit as fileupload
        $this->assertContains('<input type="file" id="dynamic_form_visit" name="dynamic_form[visit]" />', $content);
        // render name as text-input
        $this->assertContains('<input type="text" id="dynamic_form_name" name="dynamic_form[name]" />', $content);
    }

    public function testRenderDynamicFormSelects()
    {
        $content = $this->createFormTemplate();

        // render start (date) as selects
        $this->assertContains('<select id="dynamic_form_start_day" name="dynamic_form[start][day]">', $content);
        $this->assertContains('<select id="dynamic_form_start_month" name="dynamic_form[start][month]">', $content);
        $this->assertContains('<select id="dynamic_form_start_year" name="dynamic_form[start][year]">', $content);

        // render break (datetime) as selects
        $this->assertContains('<select id="dynamic_form_break_date_day" name="dynamic_form[break][date][day]">', $content);
        $this->assertContains('<select id="dynamic_form_break_date_month" name="dynamic_form[break][date][month]">', $content);
        $this->assertContains('<select id="dynamic_form_break_date_year" name="dynamic_form[break][date][year]">', $content);
        $this->assertContains('<select id="dynamic_form_break_time_hour" name="dynamic_form[break][time][hour]">', $content);
        $this->assertContains('<select id="dynamic_form_break_time_minute" name="dynamic_form[break][time][minute]">', $content);
    }

    public function testRenderDynamicFormDifcferentFormsOfGenderFields()
    {
        $content = $this->createFormTemplate();

        // render gender forms as checkboxes, radio-buttons ans select
        $this->assertContains('<input type="radio" id="dynamic_form_gender-radio_placeholder" name="dynamic_form[gender-radio]" value="" checked="checked" />', $content);
        $this->assertContains('<input type="checkbox" id="dynamic_form_gender-check_0" name="dynamic_form[gender-check][]" value="männlich" />', $content);
        $this->assertContains('<select id="dynamic_form_gender-select" name="dynamic_form[gender-select]">', $content);
    }

    /**
     * @return string
     */
    private function createFormTemplate()
    {
        $dynamicForm = $this->getEntityManager()->find(DynamicForm::class, 1);

        $form = $this
            ->getContainer()
            ->get('form.factory')
            ->create(DynamicFormType::class, null, ['dynamic_form' => $dynamicForm])
            ->createView();

        return $this
            ->getContainer()
            ->get('twig')
            ->createTemplate('{{ dynamic_form(form) }}')
            ->render(['form' => $form]);
    }
}