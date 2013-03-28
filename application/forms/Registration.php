<?php

class Application_Form_Registration extends Zend_Form
{

    public function init()
    {
// указываем имя формы
        $this->setName('Registration');
        // сообщение о незаполненном поле
        $isEmptyMessage = 'Значение не может быть пустым';
         
        // Login
        $username = new Zend_Form_Element_Text('username', array(
            'class'    => 'maxiinput'));
        $username->setLabel('Логин:')
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
		//--------------------------------------------------------------------------------------
		//Email	
        $email = new Zend_Form_Element_Text('email', array(
            'class'    => 'maxiinput'));
        $email->setLabel('Email:')
            ->setRequired(true)
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty', true,
                array('messages' => array('isEmpty' => $isEmptyMessage))
            );

        $email->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
            )); 
		//--------------------------------------------------------------------------------------
		$captcha = new Zend_Form_Element_Captcha('foo', array(
           'label' => "Введите текст:",
		   'class'    => 'maxiinput',
           'captcha' => 'Figlet',
           'captchaOptions' => array(
              'captcha' => 'Figlet',
              'wordLen' => 6,
              'timeout' => 300,
           ),
        ));
		$captcha->setDecorators(array(
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
		//--------------------------------------------------------------------------------------
        // создаём кнопку submit
        $submit = new Zend_Form_Element_Submit('registration');
        $submit->setLabel('Отправить пароль на email');
		
		$submit->setDecorators(array(
            'ViewHelper',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array(array('label' => 'HtmlTag'), array('tag' => 'td',  'placement' => 'prepend')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        ));
        // добавляем элементы в форму
        $this->addElements(array($username, $email, $captcha, $submit));
         
        // указываем метод передачи данных
        $this->setMethod('post');
		
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class'  => 'registration')),
            'Form',
        ));
    }


}

