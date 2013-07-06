<?php

class Application_Model_DbTable_Seocategory extends Zend_Db_Table_Abstract
{
        protected $_name = 'seocategory';

        public function GetSeoByCategoryId($category_id)
        {
            // Получаем id как параметр
            $category_id = (int)$category_id;            
            
            return $this->fetchRow($this->select()->where('categoryid = ?', $category_id)
                                                  ->where('cityid = ?', Zend_Registry::get('city_id')));
        }
        
        public function AddSeo($categoryid, $cityid, $title, $description, $texttop, $textleft)
        {
            $texttop=str_replace("\r\n","<br /> ",$texttop);
            $textleft=str_replace("\r\n","<br /> ",$textleft);
            $data = array(
                'categoryid' => $categoryid,
                'cityid' => $cityid,
                'title' => $title,
                'description' => $description,
                'texttop' => $texttop,
                'textleft' => $textleft,
            );
             
            // Используем метод insert для вставки записи в базу
            $this->insert($data);
        }
}

