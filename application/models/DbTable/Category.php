<?php

class Application_Model_DbTable_Category extends Zend_Db_Table_Abstract
{

    protected $_name = 'category';
	   
	   public function GetCategoryById($id)
	    {
	        $id = (int)$id;
	        return $this->fetchRow($this->select()->where('id = ?', $id));
	    }	
}

