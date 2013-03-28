<?php

class Application_Model_DbTable_Post extends Zend_Db_Table_Abstract
{

    protected $_name = 'post';
    // Метод для получения записи по id
        public function GetPost($id)
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
        
        public function GetPostByCategoryId($category_id)
        {
            // Получаем id как параметр
            $category_id = (int)$category_id;            
            $city = new Zend_City_City();  
            
            return $this->fetchAll($this->select()->where('categoryid = ?', $category_id)
                                                  ->where('cityid = ?', $city->getId())
                                                  ->order(array('id desc')));
        }
        
        public function GetPostById($id)
        {
            // Получаем id как параметр
            $id = (int)$id;
            return $this->fetchRow('id = ' . $id);
        }
         
        // Метод для добавление новой записи
        public function AddPost($categoryid, $title, $text, $price, $user_id)
        {
            $city = new Zend_City_City();
			$text=str_replace("\r\n","<br /> ",$text);
            $data = array(
                'categoryid' => $categoryid,
                'cityid' => $city->getId(),
                'title' => $title,
                'text' => $text,
                //'ip' => $ip,      
                'price' => $price,  
                //'valid' => $valid,
                'user_id' => $user_id,
            );
             
            // Используем метод insert для вставки записи в базу
            $this->insert($data);
        }
        
        public function SearchText($text)
        {
            // Получаем id как параметр
            $text = (string)$text;
            return $this->fetchRow($this->select()->where('text LIKE \'%'.$text.'%\''));
            //return $this->fetchRow('text LIKE \'%'.$text.'%\'');
        }
        
        public function Count()
        {
            $city = new Zend_City_City();

            $select = $this->select()->from(array('p' => 'post'), array('count' => 'COUNT(*)'));
            $select->where('p.cityid = ?', $city->getId());
            
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
            $city = new Zend_City_City();  
            
            return $this->fetchAll($this->select()->where('cityid = ?', $city->getId())->order(array('id desc')));         
        }   
		
        public function GetSearchPosts($text)
        {
            $city = new Zend_City_City();  
			
			return $this->fetchAll($this->select()->where('cityid = ?', $city->getId())
												  ->where('text LIKE ?', '%'.$text.'%')
												  ->order(array('id desc')));        
        } 		
        
        public function GetCountPosts($count)
        {
            $city = new Zend_City_City();
     
            return $this->fetchAll($this->select()->where('cityid = ?', $city->getId())->order(array('id desc'))->limit($count, 0));           
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
            $row = $this->GetPostById($id);
			$data = array(
                'review' => $row->review + 1,
            );           
            $this->update($data, 'id = ' . (int)$id);
        }			
}

