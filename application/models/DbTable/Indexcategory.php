<?php

class Application_Model_DbTable_Indexcategory extends Zend_Db_Table_Abstract
{

    protected $_name = 'indexcategory';

    public function GetIndexCategory($group_id)
   {
       // Получаем id как параметр
       $group_id = (int)$group_id;
      
       $post = new Application_Model_DbTable_Post();
       $firstQuery = $post->select()->from(array('post' => 'post'), array('categoryid', 'count' => 'COUNT(*)'))
                                    ->where('post.cityid = ?', Zend_Registry::get('city_id'))
                                    ->group('categoryid');
      
       $select = $this->select()->from(array('category' => 'indexcategory'), array('category_id', 'category_name'));
       $select = $select->setIntegrityCheck(false);
       $select->joinLeft(array('counter' => $firstQuery), 'category.category_id = counter.categoryid', array('count'));
       $select->where('category.group_id = ?', $group_id);          
       $select->group('category.category_id');                                                  
                
       return $this->fetchAll($select);
   }
   
    public function GetCategorys($group_id)
   {
       $post = new Application_Model_DbTable_Post();
       $firstQuery = $post->select()->from(array('post' => 'post'), array('categoryid', 'count' => 'COUNT(*)'))
                                    ->where('post.cityid = ?', Zend_Registry::get('city_id'))
                                    ->group('categoryid');
      
       $select = $this->select()->from(array('category' => 'indexcategory'), array('category_id', 'category_name'));
       $select = $select->setIntegrityCheck(false);
       $select->joinLeft(array('counter' => $firstQuery), 'category.category_id = counter.categoryid', array('count'));    
       $select->where('group_id = ?', $group_id);
       $select->group('category.category_id');                                                  
                
       return $this->fetchAll($select);
   }   
    
    public function GetIndexCategorys($group_id)
   {
       $select = $this->select()->where('group_id = ?', $group_id);           
       return $this->fetchAll($select);
   }

   public function GetCategoryById($id)
  {
      $id = (int)$id;
      return $this->fetchRow($this->select()->where('category_id = ?', $id));
  }    
}

