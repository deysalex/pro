<?php

class Application_Form_Support extends Zend_Form
{

    public function init()
    {
		//--------------------------------------------------------------------------------------
		 $email = new Zend_Form_Element_Text('email', array(
            'required'    => true,
            'label'       => 'Email:',
            'maxlength'   => '45',
			'class'       => 'input-block-level',			
            'filters'     => array('StringTrim'),
        ));
        $this->addElement($email);
		//--------------------------------------------------------------------------------------
        $title = new Zend_Form_Element_Text('title', array(
            'required'    => true,
            'label'       => 'Тема сообщения:',
            'maxlength'   => '45',
			'class'       => 'input-block-level',			
            'filters'     => array('StringTrim'),
        ));
        $this->addElement($title);
		//--------------------------------------------------------------------------------------
        $text = new Zend_Form_Element_Textarea('text', array(
            'label'       => 'Сообщение:',
            'rows'        => '10',
            'cols'        => '45',
			'class'       => 'input-block-level',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 		
        $this->addElement($text);	
		//--------------------------------------------------------------------------------------
		$recaptcha = new Zend_Service_ReCaptcha("6Le3HeESAAAAAM_eoOzyIPgUg6iKJj-fFYP3tj-5 ","6Le3HeESAAAAABVIguC5OTpOJ6G5dKWwljGxAaYX");
        $recaptcha->setOption('theme', 'clean');
        $captcha = new Zend_Form_Element_Captcha('challenge', array('captcha' => 'ReCaptcha','captchaOptions' => array('captcha' => 'ReCaptcha','service' => $recaptcha)));
		$this->addElement($captcha);	
		//--------------------------------------------------------------------------------------
        // Кнопка Submit
        $save = new Zend_Form_Element_Submit('Send', array(
            'label'       => 'Отправить',
			'class'       => 'btn pull-right btn-primary',
        )); 	
        $this->addElement($save);	
		//--------------------------------------------------------------------------------------
    }


}

