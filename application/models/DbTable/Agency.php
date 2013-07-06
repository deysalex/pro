﻿<?php

class Application_Model_DbTable_Agency extends Zend_Db_Table_Abstract
{

    protected $_name = 'agency';

    public function GetAgencys()
   {                                                                                                   
       $select = $this->select()->from(array('agency' => 'agency'), array('id', 'title', 'description', 'url', 'phone', 'address'))
                                ->where('cityid = ?', Zend_Registry::get('city_id'))
                                ->order(array('id asc'));            
       return $this->fetchAll($select);
   }
   
    public function AddAgency($title, $description, $url, $phone, $address)
   {
       $description=str_replace("&#032;",' ',$description);
       $description=str_replace(">",'&gt;',$description);
       $description=str_replace("<",'&lt;',$description);
       $description=str_replace("\"",'&quot;',$description);
       $description=str_replace("\r\n","<br> ",$description);
       $description=str_replace("\n\n",'<p>',$description);
       $description=str_replace("\n",'<br> ',$description);
       $description=str_replace("\t",'',$description);
       $description=str_replace("\r",'',$description);
       $description=str_replace('   ',' ',$description);
       
       $data = array(
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'phone' => $phone,
            'address' => $address,
            'cityid' => Zend_Registry::get('city_id'),
       );
       $this->insert($data);
   }     
}

