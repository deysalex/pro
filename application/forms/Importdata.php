﻿<?php

class Application_Form_Importdata extends Zend_Form
{

    public function init()
    {
        $isEmptyMessage = 'Значение не может быть пустым';
		//--------------------------------------------------------------------------------------
        $city = new Zend_Form_Element_Select('city', array(
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
        $this->addElement($city);			
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

