<?php

class Application_Form_Addbig extends Zend_Form
{

    public function init()
    {
        $isEmptyMessage = 'Значение не может быть пустым';
		//--------------------------------------------------------------------------------------	
        $category = new Zend_Form_Element_Select('category', array(
            'label'       => 'Категория:',
			'class'       => 'addselect',
        ));
				
		$category->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($category);
		//--------------------------------------------------------------------------------------
		
		//--------------------------------------------------------------------------------------
		//----------   1 
		//--------------------------------------------------------------------------------------		
        $title1 = new Zend_Form_Element_Text('title1', array(
            'required'    => true,
            'label'       => 'Заголовок:',
            'maxlength'   => '200',
			'class'       => 'addinput',			
            'filters'     => array('StringTrim'),
        ));
		
		$title1->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
				
		$title1->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($title1);
		//--------------------------------------------------------------------------------------
        $text1 = new Zend_Form_Element_Textarea('text1', array(
            'label'       => 'Текст:',
            'rows'        => '10',
            'cols'        => '45',
			'class'       => 'add',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 
	
		$text1->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($text1);	
		//--------------------------------------------------------------------------------------
        $price1 = new Zend_Form_Element_Text('price1', array(
            'required'    => true,
            'label'       => 'Цена:',
            'maxlength'   => '30',
			'class'       => 'addpriceinput',			
            'filters'     => array('StringTrim'),
        ));
		$price1->setDecorators(array(
            'ViewHelper',
            'Errors',		
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($price1);	
		//--------------------------------------------------------------------------------------
		//----------   2 
		//--------------------------------------------------------------------------------------
		
        $title2 = new Zend_Form_Element_Text('title2', array(
            'required'    => true,
            'label'       => 'Заголовок:',
            'maxlength'   => '200',
			'class'       => 'addinput',			
            'filters'     => array('StringTrim'),
        ));
		
		$title2->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
				
		$title2->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($title2);
		//--------------------------------------------------------------------------------------
        $text2 = new Zend_Form_Element_Textarea('text2', array(
            'label'       => 'Текст:',
            'rows'        => '10',
            'cols'        => '45',
			'class'       => 'add',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 
	
		$text2->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($text2);	
		//--------------------------------------------------------------------------------------
        $price2 = new Zend_Form_Element_Text('price2', array(
            'required'    => true,
            'label'       => 'Цена:',
            'maxlength'   => '30',
			'class'       => 'addpriceinput',			
            'filters'     => array('StringTrim'),
        ));
		$price2->setDecorators(array(
            'ViewHelper',
            'Errors',		
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($price2);	
		//--------------------------------------------------------------------------------------
		//----------   3
		//--------------------------------------------------------------------------------------
		
        $title3 = new Zend_Form_Element_Text('title3', array(
            'required'    => true,
            'label'       => 'Заголовок:',
            'maxlength'   => '200',
			'class'       => 'addinput',			
            'filters'     => array('StringTrim'),
        ));
		
		$title3->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
				
		$title3->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($title3);
		//--------------------------------------------------------------------------------------
        $text3 = new Zend_Form_Element_Textarea('text3', array(
            'label'       => 'Текст:',
            'rows'        => '10',
            'cols'        => '45',
			'class'       => 'add',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 
	
		$text3->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($text3);	
		//--------------------------------------------------------------------------------------
        $price3 = new Zend_Form_Element_Text('price3', array(
            'required'    => true,
            'label'       => 'Цена:',
            'maxlength'   => '30',
			'class'       => 'addpriceinput',			
            'filters'     => array('StringTrim'),
        ));
		$price3->setDecorators(array(
            'ViewHelper',
            'Errors',		
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($price3);	
		//--------------------------------------------------------------------------------------
		//----------   4 
		//--------------------------------------------------------------------------------------
		
        $title4 = new Zend_Form_Element_Text('title4', array(
            'required'    => true,
            'label'       => 'Заголовок:',
            'maxlength'   => '200',
			'class'       => 'addinput',			
            'filters'     => array('StringTrim'),
        ));
		
		$title4->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
				
		$title4->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($title4);
		//--------------------------------------------------------------------------------------
        $text4 = new Zend_Form_Element_Textarea('text4', array(
            'label'       => 'Текст:',
            'rows'        => '10',
            'cols'        => '45',
			'class'       => 'add',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 
	
		$text4->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($text4);	
		//--------------------------------------------------------------------------------------
        $price4 = new Zend_Form_Element_Text('price4', array(
            'required'    => true,
            'label'       => 'Цена:',
            'maxlength'   => '30',
			'class'       => 'addpriceinput',			
            'filters'     => array('StringTrim'),
        ));
		$price4->setDecorators(array(
            'ViewHelper',
            'Errors',		
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($price4);	
		//--------------------------------------------------------------------------------------
		//----------   5 
		//--------------------------------------------------------------------------------------
		
        $title5 = new Zend_Form_Element_Text('title5', array(
            'required'    => true,
            'label'       => 'Заголовок:',
            'maxlength'   => '200',
			'class'       => 'addinput',			
            'filters'     => array('StringTrim'),
        ));
		
		$title5->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
				
		$title5->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($title5);
		//--------------------------------------------------------------------------------------
        $text5 = new Zend_Form_Element_Textarea('text5', array(
            'label'       => 'Текст:',
            'rows'        => '10',
            'cols'        => '45',
			'class'       => 'add',			
            'validators'  => array(
                array('StringLength', true, array(0, 5000))
             ),
            'filters'     => array('StringTrim'),
        )); 
	
		$text5->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($text5);	
		//--------------------------------------------------------------------------------------
        $price5 = new Zend_Form_Element_Text('price5', array(
            'required'    => true,
            'label'       => 'Цена:',
            'maxlength'   => '30',
			'class'       => 'addpriceinput',			
            'filters'     => array('StringTrim'),
        ));
		$price5->setDecorators(array(
            'ViewHelper',
            'Errors',		
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($price5);	
		
		
		
		
		//--------------------------------------------------------------------------------------
        $city = new Zend_Form_Element_Select('city', array(
            'label'       => 'Город:',
			'class'       => 'addcityselect',			
        ));
		$city->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 		
        $this->addElement($city);			
		//--------------------------------------------------------------------------------------
        $valid = new Zend_Form_Element_Select('valid', array(
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
        $this->addElement($valid);	  
		//--------------------------------------------------------------------------------------
		/*$captcha = new Zend_Form_Element_Captcha('foo', array(
           'label' => "Введите текст:",
           'captcha' => 'Figlet',
           'captchaOptions' => array(
              'captcha' => 'Figlet',
              'wordLen' => 6,
              'timeout' => 300,
           ),
		   'class' => 'captcha',
        ));
		$captcha->setDecorators(array(
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($captcha);*/
		//--------------------------------------------------------------------------------------
		
		$ruls = new Zend_Form_Element_Checkbox ('ruls', array(
		   'id' => 'rulsId',
           'label' => 'Ознакомлен с правилами:',
		   'validators' => array(
              array('notEmpty', true, array(
               'messages' => array(
                'isEmpty' => $isEmptyMessage)))

           ),
		   'required' => true,
        ));
		
		$ruls->setDecorators(array(
		    'ViewHelper',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($ruls);
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

