<?php

class Application_Model_DbTable_City extends Zend_Db_Table_Abstract
{

    protected $_name = 'city';
	  
	    public function addCity($text)
	    {
	        // Формируем массив вставляемых значений
	        $data = array(
	            'name' => $text,
	        );
	         
	        // Используем метод insert для вставки записи в базу
	        $this->insert($data);
	    }
}

