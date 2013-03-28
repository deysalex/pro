<?php

class Application_Model_DbTable_Mailtemplate extends Zend_Db_Table_Abstract
{

    protected $_name = 'mailtemplate';

        public function Add($name, $text)
        {
            $text=str_replace("\r\n","<br /> ",$text);
            $data = array(
                'name' => $name,
                'text' => $text,
            );           
            $this->insert($data);
        }
		
        public function Edit($id, $name, $text)
        {
            $data = array(
                'name' => $name,
                'text' => $text,
            );           
            $this->update($data, 'id = ' . (int)$id);
        }		
		
        public function GetAll()
        { 
            return $this->fetchAll($this->select()->order(array('id desc')));         
        } 	

        public function GetById($id)
        { 
            $retval = $this->fetchRow($this->select()->where('id = ?', $id));
			$retval->text = str_replace("<br /> ","\r\n",$retval->text);
			return $retval;         
        } 		
}

