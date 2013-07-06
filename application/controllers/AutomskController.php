<?php

require_once 'AutController.php';

class AutomskController extends AutController
{

    public function init()
    {
		Zend_Registry::set('aut_controller', 'automsk');
		Zend_Registry::set('controller', 'omsk');
		Zend_Registry::set('city_id', 7);	
		Zend_Registry::set('city_name', 'Омск');
    }


}

