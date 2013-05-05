<?php

class Application_Model_DbTable_Message extends Zend_Db_Table_Abstract
{

    protected $_name = 'message';

        public function Add($text, $user_id)
        {
			$text=str_replace("\r\n","<br /> ",$text);
            $data = array(
                'text' => $text,
                'user_id' => $user_id,
            );             
            $this->insert($data);
        }
		
        public function GetByUserId($user_id)
        {
            $user_id = (int)$user_id;
            return $this->fetchAll($this->select()->where('user_id = ?', $user_id));
        }		
		
        public function GetById($id)
        {
            $id = (int)$id;
            return $this->fetchAll($this->select()->where('id = ?', $id));
        }			
}

