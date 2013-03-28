<?php

class Application_Model_DbTable_Counter extends Zend_Db_Table_Abstract
{

    protected $_name = 'counter';

    public function IncCount($category_id, $city_id)
   {
	   // Получаем id как параметр
	   $category_id = (int)$category_id;
	   $dataselect = $this->fetchAll($this->select()->where('category_id = ?', $category_id)
	                                                ->where('city_id = ?', $city_id));
	   foreach ($dataselect as $dataselectItem) {
			$data = array(
	            'count' => $dataselectItem->count + 1,
	        );
			$this->update($data, 'id = ' . $dataselectItem->id);  
       }
    }
	
	public function DecCount($category)
   {
	   // Получаем id как параметр
	   $category = (int)$category;
	   
	   $data = $this->select()->where('category_id = ?', $category);
	   foreach ($data as $dataItem) {
            $dataItem->count = $dataItem->count - 1;
       }
	   $this->update($data, 'category_id = ' . (int)$category);   
    }
}

