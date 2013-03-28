<?php

class Application_Form_Sendmail extends Zend_Form
{

    public function init()
    {
	    $isEmptyMessage = 'Значение не может быть пустым';
		//--------------------------------------------------------------------------------------
        $email = new Zend_Form_Element_Text('email', array(
            'required'    => true,
            'label'       => 'Email:',
            'maxlength'   => '200',
			'class'       => 'addinput',			
            'filters'     => array('StringTrim'),
        ));
		
		$email->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
				
		$email->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($email);
		//--------------------------------------------------------------------------------------		
        $template = new Zend_Form_Element_Select('template', array(
            'label'       => 'Шаблон:',
			'class'       => 'addselect',
        ));

		$template->addValidator(new Zend_Validate_NotEqual('0'))
               ->addErrorMessage($isEmptyMessage);

		$template->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($template);
		//--------------------------------------------------------------------------------------
        // Кнопка Submit
        $send = new Zend_Form_Element_Submit('send', array(
            'label'       => 'Отправить',
        )); 
		$send->setDecorators(array(
            'ViewHelper',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array(array('label' => 'HtmlTag'), array('tag' => 'td',  'placement' => 'prepend')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        ));		
        $this->addElement($send);	
		//--------------------------------------------------------------------------------------
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            'Form',
        ));	
    }


}

