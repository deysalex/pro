<?php

class Application_Model_DbTable_Rezume extends Zend_Db_Table_Abstract
{

    protected $_name = 'rezume';

    public function GetBySearchText($text)
    {            
        return $this->fetchAll($this->select()->where('city_id = ?', Zend_Registry::get('city_id'))
                                                ->where('about LIKE ? or education LIKE ? or skills LIKE ? or experience LIKE ? or other LIKE ? or contacts LIKE ?', '%'.$text.'%') 
                                                ->order(array('id desc')));                                             
    } 
    
    public function Add($data)
    {
        $about = str_replace("\r\n","<br /> ", $data['about']);
        $education = str_replace("\r\n","<br /> ", $data['education']);
        $skills = str_replace("\r\n","<br /> ", $data['skills']);
        $experience = str_replace("\r\n","<br /> ", $data['experience']);
        $other = str_replace("\r\n","<br /> ", $data['other']);
        $contacts = str_replace("\r\n","<br /> ", $data['contacts']);
        
        $insertdata = array(
            'categoryid' => $data['categoryid'],
            'city_id' => Zend_Registry::get('city_id'),
            'title' => $data['title'],
            'about' => $about,    
            'education' => $education,
            'skills' => $skills,
            'experience' => $experience,
            'other' => $other,
            'contacts' => $contacts,
            'user_id' => $data['user_id'],
            );
             
        $this->insert($insertdata);
    }

    public function Edit($id, $data)
    {
        $about = str_replace("\r\n","<br /> ", $data['about']);
        $education = str_replace("\r\n","<br /> ", $data['education']);
        $skills = str_replace("\r\n","<br /> ", $data['skills']);
        $experience = str_replace("\r\n","<br /> ", $data['experience']);
        $other = str_replace("\r\n","<br /> ", $data['other']);
        $contacts = str_replace("\r\n","<br /> ", $data['contacts']);
        
        $updatedata = array(
            'title' => $data['title'],
            'about' => $about,    
            'education' => $education,
            'skills' => $skills,
            'experience' => $experience,
            'other' => $other,
            'contacts' => $contacts,
        );           
        $this->update($updatedata, 'id = ' . (int)$id);
    }   
    
    public function GetById($id)
    {
        $id = (int)$id;
        return $this->fetchRow('id = ' . $id);
    }   
    
    public function GetByCategoryIdLimit($category_id, $limit)
    {
        $category_id = (int)$category_id;    
        $limit = (int)$limit;   
            
        return $this->fetchAll($this->select()->where('categoryid = ?', $category_id)
                                                ->where('city_id = ?', Zend_Registry::get('city_id'))
                                                ->order(array('id desc'))
                                                ->limit($limit, 0));
    }   
    
    public function GetByCategoryId($category_id)
    {
        $category_id = (int)$category_id;            
        $city = new Zend_City_City();  
            
        return $this->fetchAll($this->select()->where('categoryid = ?', $category_id)
                                                ->where('city_id = ?', $city->getId())
                                                ->order(array('id desc')));
    }
    
    public function GetForCurrentUser()
    {
        $user_id = -1;
        $pAuthIdentity = Zend_Auth::getInstance()->getIdentity();
        if ($pAuthIdentity) {
            $user_id = $pAuthIdentity->id;
        }
        return $this->fetchAll($this->select()->where('user_id = ?', $user_id)
                                                ->order(array('id desc')));       
    }       
    
}

