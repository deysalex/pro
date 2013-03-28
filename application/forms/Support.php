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
			'class'       => 'add',			
            'filters'     => array('StringTrim'),
        ));
		$email->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($email);
		//--------------------------------------------------------------------------------------
        $title = new Zend_Form_Element_Text('title', array(
            'required'    => true,
            'label'       => 'Тема сообщения:',
            'maxlength'   => '45',
			'class'       => 'add',			
            'filters'     => array('StringTrim'),
        ));
		$title->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($title);
		//--------------------------------------------------------------------------------------
        $text = new Zend_Form_Element_Textarea('text', array(
            'label'       => 'Сообщение:',
            'rows'        => '10',
            'cols'        => '45',
			'class'       => 'add',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 
		$text->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($text);	
		//--------------------------------------------------------------------------------------

        // Кнопка Submit
        $save = new Zend_Form_Element_Submit('Send', array(
            'label'       => 'Отправить',
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

