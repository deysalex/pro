<?php

class Application_Form_Registration extends Zend_Form
{

    public function init()
    {
        $this->setName('Registration');
        $this->setMethod('post');		
        $isEmptyMessage = 'Значение не может быть пустым';
		//--------------------------------------------------------------------------------------
        $username = new Zend_Form_Element_Text('username', array(
            'required'    => true,
            'label'       => 'Логин:',
            'maxlength'   => '200',
			'class'       => 'input-block-level',			
            'filters'     => array('StripTags', 'StringTrim'),
        ));
		
		$username->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
        $this->addElement($username);
		//--------------------------------------------------------------------------------------
        $email = new Zend_Form_Element_Text('email', array(
            'required'    => true,
            'label'       => 'Email:',
            'maxlength'   => '200',
			'class'       => 'input-block-level',			
            'filters'     => array('StripTags', 'StringTrim'),
        ));
		
		$email->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
        $this->addElement($email);
		//--------------------------------------------------------------------------------------
		$recaptcha = new Zend_Service_ReCaptcha("6Le3HeESAAAAAM_eoOzyIPgUg6iKJj-fFYP3tj-5 ","6Le3HeESAAAAABVIguC5OTpOJ6G5dKWwljGxAaYX");
        $recaptcha->setOption('theme', 'clean');
        $captcha = new Zend_Form_Element_Captcha('challenge', array('captcha' => 'ReCaptcha','captchaOptions' => array('captcha' => 'ReCaptcha','service' => $recaptcha)));
		$captcha->setDecorators(array(
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
		$this->addElement($captcha);			
		//--------------------------------------------------------------------------------------
        $submit = new Zend_Form_Element_Submit('registration', array(
            'label'       => 'Отправить пароль на email',
			'class'       => 'btn pull-right btn-primary',
        )); 
        $this->addElement($submit);	
		//--------------------------------------------------------------------------------------		   
    }

}

