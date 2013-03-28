<?php

class Application_Form_Changepass extends Zend_Form
{

    public function init()
    {
	    $isEmptyMessage = 'Значение не может быть пустым';
		//--------------------------------------------------------------------------------------	
        $password_old = new Zend_Form_Element_Password('password_old', array(
            'required'    => true,
            'label'       => 'Старый пароль:',
            'maxlength'   => '200',
			'class'       => 'addinput',			
            'filters'     => array('StringTrim'),
        ));
		
		$password_old->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
				
		$password_old->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($password_old);
		//--------------------------------------------------------------------------------------
        $password_new = new Zend_Form_Element_Password('password_new', array(
            'required'    => true,
            'label'       => 'Новый пароль:',
            'maxlength'   => '200',
			'class'       => 'addinput',			
            'filters'     => array('StringTrim'),
        ));
		
		$password_new->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
				
		$password_new->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($password_new);
		//--------------------------------------------------------------------------------------
		$password_new2 = new Zend_Form_Element_Password('password_new2', array(
            'required'    => true,
            'label'       => 'Еще раз новый пароль:',
            'maxlength'   => '200',
			'class'       => 'addinput',			
            'filters'     => array('StringTrim'),
        ));
		
		$password_new2->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
				
		$password_new2->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($password_new2);
		//--------------------------------------------------------------------------------------
        // Кнопка Submit
        $save = new Zend_Form_Element_Submit('Save', array(
            'label'       => 'Изменить',
        )); 
		$save->setDecorators(array(
            'ViewHelper',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array(array('label' => 'HtmlTag'), array('tag' => 'td',  'placement' => 'prepend')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        ));		
        $this->addElement($save);	
		//--------------------------------------------------------------------------------------
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            'Form',
        ));	
    }


}

