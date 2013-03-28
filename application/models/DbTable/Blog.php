<?php

class Application_Model_DbTable_Blog extends Zend_Db_Table_Abstract
{

    protected $_name = 'blog';

    public function GetBlogs()
   {
	   $select = $this->select()->from(array('blog' => 'blog'), array('id', 'title', 'text', 'date', 'description'))
	                            ->order(array('id desc'));		  	  
	   return $this->fetchAll($select);
   }
   
    public function AddBlog($title, $text)
   {
	   $text=str_replace("&#032;",' ',$text);
	   $text=str_replace(">",'&gt;',$text);
	   $text=str_replace("<",'&lt;',$text);
	   $text=str_replace("\"",'&quot;',$text);
	   $text=str_replace("\r\n","<br> ",$text);
	   $text=str_replace("\n\n",'<p>',$text);
	   $text=str_replace("\n",'<br> ',$text);
	   $text=str_replace("\t",'',$text);
	   $text=str_replace("\r",'',$text);
	   $text=str_replace('   ',' ',$text);
	   
	   $data = array(
	        'title' => $title,
		    'text' => $text,
	   );
	   $this->insert($data);
   }   
   
	public function GetBlogById($id)
   {
	   $id = (int)$id;
	   return $this->fetchRow('id = ' . $id);
   }   
   
}

