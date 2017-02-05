<?php

namespace MolinosForm\Form;

use MolinosForm\Form\Fieldset\FeedbackFieldset;
use Zend\Form\Element\Submit;
use Zend\Form\Form;

class FeedbackForm extends Form
{
    /**
     * FeedbackForm constructor.
     * @param int|null|string $name
     * @param array $options
     */
    public function __construct($name, array $options)
    {
        parent::__construct($name, $options);
    }

    public function init()
    {
        $this->setAttribute('method', 'POST');
        $this->setAttribute('novalidate', '');
        $this->setName('molinos_request_create');

        $this->add([
            'name' => "feedback",
            'type' => FeedbackFieldset::class,
            'options' => [
                'use_as_base_fieldset' => true,
                'label'=> 'Обратная связь'
            ],
        ]);

        $this->add([
            'name' => 'send',
            'type' => Submit::class,
            'attributes' => [
                'value' => 'Отправить'
            ]
        ]);
    }


}