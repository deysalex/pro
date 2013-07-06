<?php

class Application_Form_Add extends Zend_Form
{

    public function init()
    {
	    $isEmptyMessage = 'Значение не может быть пустым';
		//--------------------------------------------------------------------------------------	
        $category = new Zend_Form_Element_Select('category', array(
            'label'       => 'Категория:',
			'class'       => 'addselect',
        ));

		$category->addValidator(new Zend_Validate_NotEqual('0'))
               ->addErrorMessage($isEmptyMessage);
		
        $this->addElement($category);
		//--------------------------------------------------------------------------------------
        $title = new Zend_Form_Element_Text('title', array(
            'required'    => true,
            'label'       => 'Заголовок:',
            'maxlength'   => '200',
			'class'       => 'input-block-level',			
            'filters'     => array('StringTrim'),
        ));
		
		$title->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
        $this->addElement($title);
		//--------------------------------------------------------------------------------------
        $text = new Zend_Form_Element_Textarea('text', array(
            'label'       => 'Текст:',
            'rows'        => '14',
            'cols'        => '60',
			'class'       => 'input-block-level',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 
        $this->addElement($text);	
		//--------------------------------------------------------------------------------------
        $contact = new Zend_Form_Element_Textarea('contact', array(
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
        $price = new Zend_Form_Element_Text('price', array(
            'required'    => true,
            'label'       => 'З.П.:',
            'maxlength'   => '30',
			'class'       => 'input-medium input-block-level',			
            'filters'     => array('StringTrim'),
        ));	
        $this->addElement($price);	
		//--------------------------------------------------------------------------------------
		$ruls = new Zend_Form_Element_Checkbox ('ruls', array(
		   'id' => 'checkbox',
           'label' => 'Ознакомлен с правилами:',
		   'class' => 'checkbox',
		   'Checked' => true,
        ));
		
		$ruls->addValidator(new Zend_Validate_NotEqual('0'))
               ->addErrorMessage($isEmptyMessage);		
        $this->addElement($ruls);
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

