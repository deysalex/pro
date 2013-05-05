<?php

class RezumeController extends Zend_Controller_Action
{

    private $_groupid = 2;

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $Indexcategorys = new Application_Model_DbTable_Indexcategory();
        $this->view->indexcategory = $Indexcategorys->GetCategorys($this->_groupid);  
       
        $form = new Application_Form_Search();
        $this->view->form = $form;
        
        $rezumes = new Application_Model_DbTable_Rezume();
        $rezumelist = null;
        if ($this->getRequest()->isGet()) {
            $search_text = $this->getRequest()->getParam('search_text');
            $rezumelist = $rezumes->GetBySearchText($search_text);
        } else {
            $rezumelist = $rezumes->GetPosts();
        }
        $paginator = Zend_Paginator::factory($rezumelist);        
        $paginator->setCurrentPageNumber($this->_getParam('page', 1)); // page number
        $paginator->setItemCountPerPage(10); // number of items to show per page
            
        $this->view->rezume = $paginator;
        $this->view->paginator = $paginator;    

        $seo = new Application_Model_DbTable_Seo();
        $this->view->seo = $seo;
    }

    public function addrezumeAction()
    {
        $form = new Application_Form_Addrezume();   
        
        $categorys = new Application_Model_DbTable_Indexcategory();
        $form->category->addMultiOption(0, 'Выберите рубрику');
        foreach ($categorys->GetIndexCategorys($this->_groupid) as $category) {
            $form->category->addMultiOption($category->category_id, $category->category_name);
        }   
        
        $this->view->form = $form;  
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {

				$data = array(
					'categoryid' => $form->getValue('category'),
					'title' => $form->getValue('title'),
					'about' => $form->getValue('about'),    
					'education' => $form->getValue('education'),
					'skills' => $form->getValue('skills'),
					'experience' => $form->getValue('experience'),
					'other' => $form->getValue('other'),
					'contacts' => $form->getValue('contacts'),
					'user_id' => $this->GetCurrentUserId(),
				);
                $rezume = new Application_Model_DbTable_Rezume();
                $rezume->Add($data);     
                
                //$this->SendEmail('webmaster@provacancy.ru', 'webmaster@provacancy.ru', 'Add', $title, $text);
                
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }  
    }

    private function GetCurrentUserId()
    {
        $user_id = 0;
        
        $pAuthIdentity = Zend_Auth::getInstance()->getIdentity();
        if ($pAuthIdentity) {
            $usersTable = new Application_Model_DbTable_Users();
            $user_id = $usersTable->GetUserIdByName($pAuthIdentity->username); 
        }

        return $user_id;        
    }

    public function listrezumeAction()
    {
        $id = $this->_getParam('id', 0);
        if ($id > 0) {  
            $categorys = new Application_Model_DbTable_Categorygroup();
            $category = $categorys->GetCategoryWithGroupById($id);
            $this->view->title = $category['name'].' - '.$category['category_name'];
            $group_id = $category['category_group_id'];
            
            $indexcategorys = new Application_Model_DbTable_Indexcategory();
            $indexcategory = $indexcategorys->GetIndexCategory($group_id);
            $this->view->indexcategory = $indexcategory;
            
            $seocategorys = new Application_Model_DbTable_Seocategory();
            $seocategory = $seocategorys->GetSeoByCategoryId($id);
            $this->view->seocategory = $seocategory;
            
            $rezumes = new Application_Model_DbTable_Rezume();
            
            $paginator = Zend_Paginator::factory($rezumes->GetByCategoryId($id));      
            $paginator->setCurrentPageNumber($this->_getParam('page', 1)); // page number
            $paginator->setItemCountPerPage(10); // number of items to show per page
            
            $this->view->rezume = $paginator;
            $this->view->paginator = $paginator;
        }
    }

    public function editrezumeAction()
    {
        // action body
    }

    public function deleterezumeAction()
    {
        // action body
    }

    public function rezumeAction()
    {
        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            $current_rezumes = new Application_Model_DbTable_Rezume();
            $current_rezume = $current_rezumes->GetById($id);   

			if (!$current_rezume) {
				throw new Zend_Controller_Dispatcher_Exception();
			}
			
            $categorys = new Application_Model_DbTable_Indexcategory();
            $categorys = $categorys->GetCategorys($this->_groupid);

            $current_categorys = new Application_Model_DbTable_Indexcategory();
            $current_category = $current_categorys->GetCategoryById($current_rezume->categoryid); 
            $this->view->indexcategory = Array('current_category' => $current_category, 'list' => $categorys);  

            $similar_rezumes = new Application_Model_DbTable_Rezume();
            $similar_rezume = $similar_rezumes->GetByCategoryIdLimit($current_rezume->categoryid, 5); 

            $this->view->rezume = Array('current_rezume' => $current_rezume, 'similar_rezume' => $similar_rezume);    
        }
    }


}











