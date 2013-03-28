<?php

class Application_Form_Message extends Zend_Form
{

    public function init()
    {
        $this->setName('Message');
        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение не может быть пустым';
         
        // Login
        $username = new Zend_Form_Element_Text('username', array(
            'class'    => 'maxiinput'));
        $username->setLabel('Message')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );
			
        $username->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
            )); 
		$this->addElement($username);
		
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class'  => 'registration')),
            'Form',
        ));
    }
}

