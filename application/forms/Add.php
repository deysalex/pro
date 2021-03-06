﻿<?php

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
            'label'       => 'Заголовок:',
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
        $text = new Zend_Form_Element_Textarea('text', array(
            'label'       => 'Текст:',
            'rows'        => '20',
            'cols'        => '60',
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
        $price = new Zend_Form_Element_Text('price', array(
            'required'    => true,
            'label'       => 'З.П.:',
            'maxlength'   => '30',
			'class'       => 'addpriceinput',			
            'filters'     => array('StringTrim'),
        ));
		$price->setDecorators(array(
            'ViewHelper',
            'Errors',		
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($price);	
		//--------------------------------------------------------------------------------------
        /*$city = new Zend_Form_Element_Select('city', array(
            'label'       => 'Город:',
			'class'       => 'addcityselect',			
        ));
		
		$city->addValidator(new Zend_Validate_NotEqual('0'))
               ->addErrorMessage($isEmptyMessage);
			   
		$city->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($city);*/			
		//--------------------------------------------------------------------------------------
        /*$valid = new Zend_Form_Element_Select('valid', array(
            'label'       => 'Срок действия:',
			'class'       => 'addcityselect',			
			'MultiOptions' => array('7 Дней', '14 Дней', '30 Дней', '60 Дней'),
        ));
			   
		$valid->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($valid);	*/  
		//--------------------------------------------------------------------------------------
		$ruls = new Zend_Form_Element_Checkbox ('ruls', array(
		   'id' => 'rulsId',
           'label' => 'Ознакомлен с правилами:',
		   'Checked' => true,
        ));
		
		$ruls->addValidator(new Zend_Validate_NotEqual('0'))
               ->addErrorMessage($isEmptyMessage);		
		
		$ruls->setDecorators(array(
		    'ViewHelper',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($ruls);
		//--------------------------------------------------------------------------------------	
		/*$captcha = new Zend_Form_Element_Captcha('foo', array(
           'label' => "Введите текст:",
		   'class'    => 'maxiinput',
           'captcha' => 'Figlet',
           'captchaOptions' => array(
              'captcha' => 'Figlet',
              'wordLen' => 6,
              'timeout' => 300,
           ),
        ));
		$captcha->setDecorators(array(
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
		$this->addElement($captcha);*/
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

