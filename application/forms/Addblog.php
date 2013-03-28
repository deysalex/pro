<?php

class Application_Form_Addblog extends Zend_Form
{

    public function init()
    {
	    $isEmptyMessage = 'Значение не может быть пустым';
		//--------------------------------------------------------------------------------------	
        $title = new Zend_Form_Element_Text('title', array(
            'required'    => true,
            'label'       => 'Заголовок:',
            'maxlength'   => '200',		
            'filters'     => array('StringTrim'),
        ));
		
		$title->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
				
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
            'label'       => 'Текст:',
            'cols'        => '45',		
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
        $save = new Zend_Form_Element_Submit('Save', array(
            'label'       => 'Сохранить',
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

