<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{

    protected $_name = 'users';	
		
		public function AddUser($username, $password, $email)
	    {
	        $guest = 'admin';
			$data = array(
	            'username' => $username,
				'password' => $password,
			    'email' => $email,
                'role'	=> $guest,			
	        );
	         
	        $this->insert($data);
	    }

		public function CheckExistUsername($username)
	    {
	        $row = $this->fetchRow($this->select()->where('username = ?',$username));
			if($row) {
			    return true;
	        }
	        return false;
	    }	

		public function CheckExistEmail($email)
	    {
	        $row = $this->fetchRow($this->select()->where('email = ?',$email));
			if ($row) {
	            return true;
	        }			
	        return false;
	    }			
		
		public function GetUserIdByName($name) 
		{
			$rows = $this->fetchAll($this->select()->where('username = ?', $name));
	        foreach ($rows as $row) {
                return $row->id;
            }
			return 0;
	    }
		
		public function ChangePassword($id, $newpassword) 
		{
            $data = array(
                'password' => $newpassword,
            );           
            $this->update($data, 'id = ' . (int)$id);
	    }		
}

