<?php

class Application_Form_Editpost extends Zend_Form
{

    public function init()
    {
	    $isEmptyMessage = 'Значение не может быть пустым';
		//--------------------------------------------------------------------------------------	
        $title = new Zend_Form_Element_Text('title', array(
            'required'    => true,
            'label'       => 'Заголовок:',
            'maxlength'   => '200',
			'class'       => 'input-medium input-block-level',			
            'filters'     => array('StringTrim'),
        ));
		$title->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));		 
        $this->addElement($title);
		//--------------------------------------------------------------------------------------
        $text = new Zend_Form_Element_Textarea('text', array(
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
        $price = new Zend_Form_Element_Text('price', array(
            'required'    => true,
            'label'       => 'З.П.:',
            'maxlength'   => '30',
			'class'       => 'input-medium input-block-level',			
            'filters'     => array('StringTrim'),
        )); 		
        $this->addElement($price);	
		//--------------------------------------------------------------------------------------		
        // Кнопка Submit
        $save = new Zend_Form_Element_Submit('Save', array(
            'label'       => 'Сохранить',
			'class'       => 'btn pull-right btn-primary',
        )); 	
        $this->addElement($save);	
		//--------------------------------------------------------------------------------------	
    }


}

