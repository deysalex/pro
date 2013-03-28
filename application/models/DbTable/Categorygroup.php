<?php

class Application_Model_DbTable_Categorygroup extends Zend_Db_Table_Abstract
{

    protected $_name = 'categorygroup';
    // ����� ��� ��������� ������ �� id
	    public function GetCategoryGroup($id)
	    {
	        // �������� id ��� ��������
	        $id = (int)$id;
	 
	        // ���������� ����� fetchRow ��� ��������� ������ �� ����.
	        // � ������� ��������� ������� ������� (��������� ��� ��� where)
	        $row = $this->fetchRow($this->select()->where('id = ?', $id));
	 
	        // ���� ��������� ������, ���������� ����������
	        if(!$row) {
	            throw new Exception("��� ������ � id - $id");
	        }
	        // ���������� ���������, ����������� � ������
	        return $row->toArray();
	    }
	     
	    // ����� ��� ���������� ����� ������
	    public function AddCategoryGroup($id, $name)
	    {
	        // ��������� ������ ����������� ��������
	        $data = array(
	            'id' => $id,
	            'name' => $name,			
	        );
	         
	        // ���������� ����� insert ��� ������� ������ � ����
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

