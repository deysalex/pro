<?php

class Application_Model_DbTable_City extends Zend_Db_Table_Abstract
{

    protected $_name = 'city';
	  
	    public function addCity($text)
	    {
	        // ��������� ������ ����������� ��������
	        $data = array(
	            'name' => $text,
	        );
	         
	        // ���������� ����� insert ��� ������� ������ � ����
	        $this->insert($data);
	    }
}

