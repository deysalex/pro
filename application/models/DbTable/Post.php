<?php

class Application_Model_DbTable_Post extends Zend_Db_Table_Abstract
{

    protected $_name = 'post';

        public function GetPost($id)
        {
            $id = (int)$id;
            $row = $this->fetchRow($this->select()->where('id = ?', $id));
            if(!$row) {
                throw new Exception("Нет записи с id - $id");
            }
            return $row->toArray();
        }
        
        public function GetPostByCategoryId($category_id)
        {
            $category_id = (int)$category_id;            
            
            return $this->fetchAll($this->select()->where('categoryid = ?', $category_id)
                                                  ->where('cityid = ?', Zend_Registry::get('city_id'))
                                                  ->order(array('id desc')));
        }
        
        public function GetPostByCategoryIdLimit($category_id, $limit)
        {
            $category_id = (int)$category_id;    
            $limit = (int)$limit;   
            
            return $this->fetchAll($this->select()->where('categoryid = ?', $category_id)
                                                  ->where('cityid = ?', Zend_Registry::get('city_id'))
                                                  ->order(array('id desc'))
                                                  ->limit($limit, 0));
        }       
        
        public function GetById($id)
        {
            return $this->fetchRow($this->select()->where('id = ?', $id)); 
        }
         
        // Метод для добавление новой записи
        public function AddPost($categoryid, $title, $text, $price, $user_id)
        {
            $text=str_replace("\r\n","<br /> ",$text);
            $data = array(
                'categoryid' => $categoryid,
                'cityid' => Zend_Registry::get('city_id'),
                'title' => $title,
                'text' => $text,
                'price' => $price,  
                'user_id' => $user_id,
            );
            $this->insert($data);
        }
        
        public function SearchText($text)
        {
            $text = (string)$text;
            return $this->fetchRow($this->select()->where('text LIKE \'%'.$text.'%\''));
        }
        
        public function Count()
        {
            $select = $this->select()->from(array('p' => 'post'), array('count' => 'COUNT(*)'));
            $select->where('p.cityid = ?', Zend_Registry::get('city_id'));
            
            return $this->fetchRow($select);
        }
        
        public function CheckExistPost($text)
        {
            $text = (string)$text;
            $row = $this->fetchRow($this->select()->where('text = ?', $text));
            if(!$row) {
                return false;
            } else {
                return true;
            }
        }
        
        public function GetPosts()
        {            
            return $this->fetchAll($this->select()->where('cityid = ?', Zend_Registry::get('city_id'))->order(array('id desc')));         
        }   
        
        public function GetSearchPosts($text)
        {   
            return $this->fetchAll($this->select()->where('cityid = ?', Zend_Registry::get('city_id'))
                                                  ->where('text LIKE ?', '%'.$text.'%')
                                                  ->order(array('id desc')));        
        }       
        
        public function GetCountPosts($count)
        {     
            return $this->fetchAll($this->select()->where('cityid = ?', Zend_Registry::get('city_id'))->order(array('id desc'))->limit($count, 0));           
        }
        
        public function GetPostCurrentUser()
        {
            $user_id = -1;
            $pAuthIdentity = Zend_Auth::getInstance()->getIdentity();
            if ($pAuthIdentity) {
                $user_id = $pAuthIdentity->id;
            }
            return $this->fetchAll($this->select()->where('user_id = ?', $user_id)
                                                  ->order(array('id desc')));       
        }   

        public function DeletePostById($id)
        {
            $this->delete('id = ' . (int)$id);  
        }  

        public function IncReview($id)
        {
            $row = $this->GetById($id);
            $data = array(
                'review' => $row->review + 1,
            );           
            $this->update($data, 'id = ' . (int)$id);
        }   

        public function GetAllToExportYandex($city_id)
        {               
            return $this->fetchAll($this->select()->where('date > DATE_SUB(NOW(), INTERVAL 1 MONTH)')
                                                  ->where('cityid = ?', $city_id)
                                                  ->order(array('id desc')));
        }   

        public function Edit($id, $title, $text, $price)
        {
            $text=str_replace("\r\n","<br /> ",$text);
            $data = array(
                'title' => $title,
                'text' => $text,
                'price' => $price,
            );           
            $this->update($data, 'id = ' . (int)$id);
        }       
}

