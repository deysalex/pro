<?php

class Application_Form_Addseocategory extends Zend_Form
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

		$category->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($category);
		//--------------------------------------------------------------------------------------
        $title = new Zend_Form_Element_Text('title', array(
            'required'    => true,
            'label'       => 'title:',
            'maxlength'   => '200',
			'class'       => 'addinput',			
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
        $description = new Zend_Form_Element_Textarea('description', array(
            'label'       => 'Description:',
            'rows'        => '10',
            'cols'        => '45',
			'class'       => 'add',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 
	
		$description->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($description);	
		//--------------------------------------------------------------------------------------
        $texttop = new Zend_Form_Element_Textarea('texttop', array(
            'label'       => 'texttop:',
            'rows'        => '10',
            'cols'        => '45',
			'class'       => 'add',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 
	
		$texttop->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($texttop);	
		//--------------------------------------------------------------------------------------
        $textleft = new Zend_Form_Element_Textarea('textleft', array(
            'label'       => 'textleft:',
            'rows'        => '10',
            'cols'        => '45',
			'class'       => 'add',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 
	
		$textleft->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($textleft);	
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

