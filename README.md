# DynamicFormBundle

[![Latest Stable Version](https://poser.pugx.org/fjogeleit/dynamic-form-bundle/v/stable)](https://packagist.org/packages/fjogeleit/dynamic-form-bundle)
[![Build Status](https://travis-ci.org/fjogeleit/dynamic-form-bundle.svg?branch=master)](https://travis-ci.org/fjogeleit/dynamic-form-bundle)
[![License](https://poser.pugx.org/fjogeleit/dynamic-form-bundle/license)](https://packagist.org/packages/fjogeleit/dynamic-form-bundle)

A Symfony bundle to create database driven dynamic Forms and save them.

* create Forms with an Backend like SonataAdmin Bundle
* improve Form usability with dynamic text-elements like headlines or text
* support different form-fields like input, textarea, checkbox-group, radio-group, file-input
* flexible extensible with custom FormTypes and FormType configurations
* it is passible to integrate subforms and save values as custom ORM Entities

## Requirements
                                                                                             
* PHP >= 5.6
* Composer                                                                                        

## Install via Composer

```composer require fjogeleit/dynamic-form-bundle```

## Configuration

    dynamic_form:
        file_upload_dir: 'uploads'  # upload directory for FileValues with web/ as root-dir
        form_field:                 # disable field options to configure
            disable_options:
              - 'disabled'
              - 'label'
              - 'placeholder'
              - 'required'
              
## Backend Routing

Activate the dynamic-form-bundle routes in your project routing.

    dynamic_form:
      resource: "@DynamicFormBundle/Controller/"
      type:     annotation
      prefix:   "dynamic-form"
      
### Install SonataAdminBundle

See [Sonata Project](https://sonata-project.org/bundles/admin/3-x/doc/index.html)


## Different ValueType-Supprt

Examples:

* String
* DateTime
* Entity
* simple Array
* Choice(s)
* Float
* ...

## Integrate custom Subforms

### Create the Symfony FormType

    class ContactType extends AbstractType
    {
        public function buildForm(FormBuilderInterface $builder, array $options)
        {
            $builder->add('name', TextType::class);
            $builder->add('email', TextType::class);
        }
    
        public function configureOptions(OptionsResolver $resolver)
        {
            $resolver->setDefaults([
                'data_class' => Contact::class,
                'label' => false
            ]);
        }
    }
    
### Create the ConfigurationObject for the new Subform

This Object has to implement the DynamicFormType "ConfigurationInterface".

    use AppBundle\FormType\ContactType;
    use DynamicFormBundle\Entity\DynamicResult\ResultValue\EntityValue;
    use DynamicFormBundle\Services\FormType\ConfigurationInterface;
    use DynamicFormBundle\Statics\FormFieldOptions\BaseOptions;

    class ContactConfiguration implements ConfigurationInterface
    {
        /**
         * @return string
         */
        public function getName()
        {
            return 'contact';
        }
    
        /**
         * @return string
         */
        public function getFormTypeClass()
        {
            return ContactType::class;
        }
    
        /**
         * @return string
         */
        public function getValueClass()
        {
            return EntityValue::class;
        }
    
        /**
         * @return array
         */
        public function getAvailableOptions()
        {
            return BaseOptions::all();
        }
    }

It defines:

* the backend-naming of the field
* the new FormType that should be render in the frontend
* which kind of value would be save
* * our ContactType save his values as Contact-Entity (data_class), so its value type is an EntityValue
* an array of option that could be configured for this field, like required.

at least configure the ContactConfiguration as Service with the TagName: "form.type_configuration"

    services:
      app.dynamic_form_type.contact.configuration:
        class: 'AppBundle\Services\DynamicFormType\Configuration\ContactConfiguration'
        tags:
          - { name: 'form.type_configuration' }
          
Now the new Contact Subform is as new FormField in the backend available.

### EntityValue

To use an custom Entity as "data_class" for DynamicForm subforms it has to extend the DynamicForm:AbstractEntity Class.

    use Doctrine\ORM\Mapping as ORM;
    use DynamicFormBundle\Entity\AbstractEntity;
    
    /**
     * @ORM\Entity
     * @ORM\Table(name="contact")
     *
     * @package DynamicFormBundle\Tests\Functional\Fixtures\Entity
     */
    class Contact extends AbstractEntity
    {
        /**
         * @var string
         *
         * @ORM\Column(type="string")
         */
        private $name;
    
        /**
         * @var string
         *
         * @ORM\Column(type="string")
         */
        private $email;
    
        /**
         * @param string  $name
         * @param string  $email
         */
        public function __construct($name = null, $email = null)
        {
            $this->name = $name;
            $this->email = $email;
        }
    
        /**
         * @return string
         */
        public function getName()
        {
            return $this->name;
        }
    
        /**
         * @param string $name
         *
         * @return $this
         */
        public function setName($name)
        {
            $this->name = $name;
    
            return $this;
        }
    
        /**
         * @return string
         */
        public function getEmail()
        {
            return $this->email;
        }
    
        /**
         * @param string $email
         *
         * @return $this
         */
        public function setEmail($email)
        {
            $this->email = $email;
    
            return $this;
        }
    }
