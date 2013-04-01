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
		
        public function GetStat()
        {          
			$post = new Application_Model_DbTable_Post();
			$firstQuery = $post->select()->from(array('post' => 'post'), array('cityid', 'count' => 'COUNT(*)'))
										->group('cityid');
	  
			$select = $this->select()->from(array('city' => 'city'), array('id', 'name'));
			$select = $select->setIntegrityCheck(false);
			$select->joinLeft(array('counter' => $firstQuery), 'city.id = counter.cityid', array('count'));         
			//$select->group('category.category_id');													
				
			return $this->fetchAll($select);
        }			
}

