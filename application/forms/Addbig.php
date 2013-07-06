<?php

class Application_Form_Addbig extends Zend_Form
{
	private $_isEmptyMessage = 'Значение не может быть пустым';
    
	public function init()
    {
		$url = new Zend_Form_Element_Text('url', array(
            'label'       => 'URL:',
            'rows'        => '1',
            'cols'        => '60',
			'class'       => 'input-block-level',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 
			
        $this->addElement($url);	
		//--------------------------------------------------------------------------------------		
		$category = new Zend_Form_Element_Select('category', array(
            'label'       => 'Категория:',
			'class'       => 'addselect',
        ));

		$category->addValidator(new Zend_Validate_NotEqual('0'))
               ->addErrorMessage($this->_isEmptyMessage);
		
        $this->addElement($category);
		//--------------------------------------------------------------------------------------
		for ($i = 0; $i < 5; $i += 1) {
            $this->addItem($i);
        }
		//--------------------------------------------------------------------------------------
		// Кнопка Submit
        $save = new Zend_Form_Element_Submit('Save', array(
            'label'       => 'Сохранить',
        )); 	
        $this->addElement($save);	
		//--------------------------------------------------------------------------------------
        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table')),
            'Form',
        ));	
    }
	
	public function addItem($index)
    {
		$title = new Zend_Form_Element_Text('title_'.$index, array(
            'label'       => 'Заголовок:',
            'rows'        => '1',
            'cols'        => '60',
			'class'       => 'input-block-level',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 		
        $this->addElement($title);	
		//--------------------------------------------------------------------------------------
        $text = new Zend_Form_Element_Textarea('text_'.$index, array(
            'label'       => 'Текст:',
            'rows'        => '20',
            'cols'        => '60',
			'class'       => 'input-block-level',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 	
        $this->addElement($text);	
		//--------------------------------------------------------------------------------------
        $contact = new Zend_Form_Element_Textarea('contact_'.$index, array(
            'label'       => 'Контакты:',
            'rows'        => '5',
            'cols'        => '60',
			'class'       => 'input-block-level',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 		
        $this->addElement($contact);	
		//--------------------------------------------------------------------------------------	
		$price = new Zend_Form_Element_Text('price_'.$index, array(
            'label'       => 'З.П.:',
            'rows'        => '1',
            'cols'        => '60',
			'class'       => 'input-block-level',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 		
        $this->addElement($price);		
	}


}

