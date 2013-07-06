<?php

class Application_Form_Addagency extends Zend_Form
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
        $description = new Zend_Form_Element_Textarea('description', array(
            'label'       => 'Описание:',
            'cols'        => '50',  
            'rows'        => '10',              
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
        $url = new Zend_Form_Element_Text('url', array(
            'required'    => true,
            'label'       => 'Адрес сайта:',
            'maxlength'   => '200',     
            'filters'     => array('StringTrim'),
            'value'       => 'http://',
        ));
        
        $url->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
                
        $url->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($url);
        //--------------------------------------------------------------------------------------    
        $phone = new Zend_Form_Element_Text('phone', array(
            'required'    => true,
            'label'       => 'Телефон:',
            'maxlength'   => '200',     
            'filters'     => array('StringTrim'),
        ));
        
        $phone->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
                
        $phone->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($phone);
        //--------------------------------------------------------------------------------------
        $address = new Zend_Form_Element_Text('address', array(
            'required'    => true,
            'label'       => 'Адрес:',
            'maxlength'   => '200',     
            'filters'     => array('StringTrim'),
            'value'       => Zend_Registry::get('city_name') . ', ',
        ));
        
        $address->addValidator('NotEmpty', true,
            array('messages' => array('isEmpty' => $isEmptyMessage)));
                
        $address->setDecorators(array(
            'ViewHelper',
            'Errors',
            array(array('data' => 'HtmlTag'), array('tag' => 'td', 'class'  => 'element')),
            array('Label', array('tag' => 'td')),
            array(array('row' => 'HtmlTag'), array('tag' => 'tr')),
        )); 
        $this->addElement($address);
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

