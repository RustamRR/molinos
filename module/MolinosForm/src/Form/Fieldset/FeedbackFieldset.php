<?php

namespace MolinosForm\Form\Fieldset;

use MolinosForm\Entity\Feedback;
use Zend\Form\Element\File;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Fieldset;
use Zend\InputFilter\InputFilterProviderInterface;
use Zend\Stdlib\InitializableInterface;
use Zend\Validator\EmailAddress;
use Zend\Validator\Regex;
use Zend\Validator\StringLength;
use Zend\Stdlib\Hydrator\HydratorInterface;

class FeedbackFieldset extends Fieldset implements InputFilterProviderInterface, InitializableInterface
{

    /* @var array */
    protected $inputFilterSpecification = array(
        'name' => array(
            'required' => true,
            'allow_empty' => false,
            'filters'  => array(
                array('name' => 'Zend\Filter\StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 255,
                    ),
                ),
            ),
        ),
        'email' => array(
            'required' => true,
            'allow_empty' => false,
            'filters'  => array(
                array('name' => 'Zend\Filter\StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 3,
                        'max'      => 255,
                    ),
                ),
                array (
                    'name' => 'Regex',
                    'options' => array(
                        'pattern'=>'/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/',
                        'messages' => array(
                            Regex::NOT_MATCH    => 'Please provide a valid email address.',
                        ),
                    ),
                    'break_chain_on_failure' => true
                ),
            ),
        ),
        'question' => array(
            'required' => true,
            'allow_empty' => false,
            'filters'  => array(
                array('name' => 'Zend\Filter\StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 1,
                        'max'      => 1000,
                    ),
                ),
            ),
        ),
        'image' => array(
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => '\Zend\Validator\File\IsImage',
                    'options' => ['message' => 'File has to be valid image.'],
                    'break_chain_on_failure' => true,
                ),
            ),
        )
    );
    /**
     * Should return an array specification compatible with
     * {@link Zend\InputFilter\Factory::createInputFilter()}.
     *
     * @return array
     */
    public function getInputFilterSpecification()
    {
        return $this->inputFilterSpecification;
    }

    /**
     * @param mixed $inputFilterSpecification
     */
    public function setInputFilterSpecification(array $inputFilterSpecification)
    {
        $this->inputFilterSpecification = $inputFilterSpecification;
    }



    public function init()
    {
        $this->add([
            'name' => 'question',
            'type' => Textarea::class,
            'options' => array(
                'label' => 'Ваш вопрос',
            ),
            'attributes' => array(
                'required' => true,
                'maxlength' => 1000
            )

        ]);

        $this->add([
            'name' => 'email',
            'type' => Text::class,
            'options' => array(
                'label' => 'Email',
            ),
            'attributes' => array(
                'required' => true,
                'maxlength' => 255
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 3,
                        'max'      => 100,
                    ),
                ),
            ),
        ]);

        $this->add([
            'name' => 'name',
            'type' => Text::class,
            'options' => array(
                'label' => 'Имя',
            ),
            'attributes' => array(
                'required' => true,
                'maxlength' => 255
            )
        ]);

        $this->add([
            'name' => 'image',
            'type' => File::class,
            'options' => array(
                'label' => 'Изображение'
            ),
            'attributes' => array(
                'required' => true
            ),
        ]);

        $this->add(array(
            'name' => 'captcha',
            'type' => 'Captcha',
            'attributes' => array(
                'id'    => 'captcha',
                'autocomplete' => 'off',
                'required'     => 'required'
            ),
            'options'    => array(
                'label' => 'Captcha :',
                'captcha' => new \Zend\Captcha\Image(array(
                    'font' => 'public/fonts/arial.ttf',
                    'wordLen' => 5,
                    'imgDir' => 'public/img/captcha',
                    'imgUrl' => 'img/captcha'
                ))
            ),
        ));

        $this->setObject(new Feedback());
    }

    public function bindValues(array $values = array())
    {
        foreach ($values as $key => $value) {
            if (is_null($value) === true) {
                unset($values[$key]);
            }
        }

        return parent::bindValues($values); // TODO: Change the autogenerated stub
    }

    public function getHydrator()
    {
        return parent::getHydrator(); // TODO: Change the autogenerated stub
    }

    public function setHydrator(HydratorInterface $hydrator)
    {
        return parent::setHydrator($hydrator); // TODO: Change the autogenerated stub
    }


}