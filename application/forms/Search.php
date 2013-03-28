<?php

class Application_Form_Search extends Zend_Form
{

   public function init()
    {
	    $this->setMethod('get');
		$isEmptyMessage = 'Значение не может быть пустым';
		//--------------------------------------------------------------------------------------	
        $text = new Zend_Form_Element_Text('search_text', array(
            'required'    => true,
            'label'       => 'Поиск:',
            'maxlength'   => '200',
			'class'       => 'search_text',			
            'filters'     => array('StringTrim'),
        ));
				
		$text->setDecorators(array(
            'ViewHelper',
            'Errors',
            /*array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class'  => 'search_data')),*/
            /*array('Label', array('tag' => 'div')),*/
            array(array('row' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'search_row')),
        )); 
        $this->addElement($text);
		//--------------------------------------------------------------------------------------		
        // Кнопка Submit
        $save = new Zend_Form_Element_Submit('Search', array(
            'label'       => 'Поиск',
			'class'       => 'search_button',	
        )); 
		$save->setDecorators(array(
            'ViewHelper',
            /*array(array('data' => 'HtmlTag'), array('tag' => 'div', 'class'  => 'search_data')),*/
            /*array(array('label' => 'HtmlTag'), array('tag' => 'div', 'placement' => 'prepend')),*/
            array(array('row' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'search_row_button')),
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

