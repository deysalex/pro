<?php

class Application_Model_DbTable_Categorygroup extends Zend_Db_Table_Abstract
{

    protected $_name = 'categorygroup';
    // Метод для получения записи по id
	    public function GetCategoryGroup($id)
	    {
	        // Получаем id как параметр
	        $id = (int)$id;
	 
	        // Используем метод fetchRow для получения записи из базы.
	        // В скобках указываем условие выборки (привычное для вас where)
	        $row = $this->fetchRow($this->select()->where('id = ?', $id));
	 
	        // Если результат пустой, выкидываем исключение
	        if(!$row) {
	            throw new Exception("Нет записи с id - $id");
	        }
	        // Возвращаем результат, упакованный в массив
	        return $row->toArray();
	    }
	     
	    // Метод для добавление новой записи
	    public function AddCategoryGroup($id, $name)
	    {
	        // Формируем массив вставляемых значений
	        $data = array(
	            'id' => $id,
	            'name' => $name,			
	        );
	         
	        // Используем метод insert для вставки записи в базу
	        $this->insert($data);
	    }
		
       public function GetCategoryWithGroup()
      {
	   $select = $this->select()->from(array('c' => 'categorygroup'),
                    array('name' => '(c.category_group_name)')
                   );
	   $select = $select->setIntegrityCheck(false);
	   $select->joinLeft('indexcategory', 'indexcategory.group_id = c.category_group_id');
	   return $this->fetchAll($select);
	   
      }		

       public function GetCategoryWithGroupById($category_id)
      {
	   $select = $this->select()->from(array('c' => 'categorygroup'),
                    array('name' => '(c.category_group_name)', 'category_group_id')
                   );
	   $select = $select->setIntegrityCheck(false);
	   $select->joinLeft('indexcategory', 'indexcategory.group_id = c.category_group_id')
	          ->where('category_id = ?', $category_id);
	   return $this->fetchRow($select);
	   
      }	 
}

