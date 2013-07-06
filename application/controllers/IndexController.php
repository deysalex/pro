<?php

class IndexController extends Zend_Controller_Action
{
    private $_groupid = 1;
    
    public function init()
    {
        Zend_Registry::set('aut_controller', 'aut');
		Zend_Registry::set('controller', 'index');
        Zend_Registry::set('city_id', 1);   
        Zend_Registry::set('city_name', 'Томск'); 
		Zend_Registry::set('title_prefix', 'Вакансии в Томске. Работа в Томски. ProVacancy.ru. | '); 	
		Zend_Registry::set('logo_text', 'Вакансии в Томске'); 		
		Zend_Registry::set('seo_text', 'Работа в Томске'); 		
		Zend_Registry::set('top_text', 'Вакансии в Томске и Томской области на сайте ProVacancy.ru. Вся работа в Томске. Самые свежие, самые последние вакансии, от прямых работодателей и кадровых агентств!'); 
		Zend_Registry::set('buttom_text', 'Работа  в   Томске : легко найти
                На сайте ProVacancy Вас ждет не только банк  вакансий  в   Томске , но и много другой полезной информации: новости рынка труда, обзоры, информационные материалы, каталог кадровых агентств и работодателей, советы по составлению резюме и т.д. Найти работу  в   Томске  несложно: для того, чтобы разместить  вакансию, Вам понадобится всего несколько минут. 
                ProVacancy старается помочь всем и каждому независимо от социального статуса и семейного положения. Широкие возможности отбора  вакансий  на сайте помогут найти работу  в   Томске  без опыта, по совместительству, со свободным графиком, вахтовым методом - параметры поиска могут быть разными. Достойные работа и зарплата в лучших компаниях  в   Томске  ждут Вас!');
		Zend_Registry::set('left_text', 'Работа, резюме и вакансии в Томске на PROVACANCY.RU! Мы предлагаем сервис поиска работы. Соискателям PROVACANCY.RU позволяет найти работу в Томске и регионах. Перспективная работа на PROVACANCY.RU. Работа в Томске на PROVACANCY.RU - не просто job-сайт или биржа труда, это качественная база вакансий Томска и лучший сервис для поиска работы! Работа в Томске - PROVACANCY.RU Мы работаем, чтобы Вы работали! '); 
		Zend_Registry::set('current_category_id', 0); 
		$Indexcategorys = new Application_Model_DbTable_Indexcategory();
        $this->view->indexcategory = $Indexcategorys->GetCategorys($this->_groupid); 		
    }

    public function indexAction()
    {
        $form = new Application_Form_Search();
        $this->view->form = $form;
        
        $posts = new Application_Model_DbTable_Post();
        $postlist = null;
        if ($this->getRequest()->isGet()) {
            $search_text = $this->getRequest()->getParam('search_text');
            $postlist = $posts->GetSearchPosts($search_text);
        } else {
            $postlist = $posts->GetPosts();
        }
        $paginator = Zend_Paginator::factory($postlist);        
        $paginator->setCurrentPageNumber($this->_getParam('page', 1)); // page number
        $paginator->setItemCountPerPage(10); // number of items to show per page
            
        $this->view->post = $paginator;
        $this->view->paginator = $paginator;    

        $seo = new Application_Model_DbTable_Seo();
        $this->view->seo = $seo;
		
		$Indexcategorys = new Application_Model_DbTable_Indexcategory();
        $this->view->indexcategory = $Indexcategorys->GetCategorys($this->_groupid); 		
    }

    public function addAction()
    {
        $form = new Application_Form_Add();
        
        $categorys = new Application_Model_DbTable_Indexcategory();
        $form->category->addMultiOption(0, 'Выберите рубрику');
        foreach ($categorys->GetIndexCategorys($this->_groupid) as $category) {
            $form->category->addMultiOption($category->category_id, $category->category_name);
        }  		

        $this->view->form = $form; 
		
		$Indexcategorys = new Application_Model_DbTable_Indexcategory();
        $this->view->indexcategory = $Indexcategorys->GetCategorys($this->_groupid);		

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();

            if ($form->isValid($formData)) {

                $category = $form->getValue('category');
                $title = $form->getValue('title');
                $text = $form->getValue('text') . "\r\n" . $form->getValue('contact');
                $price = $form->getValue('price');

                $user_id = $this->GetCurrentUserId();
                
                $post = new Application_Model_DbTable_Post();
                $post->AddPost($category, $title, $text, $price, $user_id);     
                
                $this->SendEmail('webmaster@provacancy.ru', 'webmaster@provacancy.ru', 'Add', $title, $text);
                
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

    public function editAction()
    {

    }

    public function deleteAction()
    {

    }

    public function rulsAction()
    {
        $form = new Application_Form_Ruls();
        $this->view->form = $form;   
    }

    public function postlistAction()
    {
        // Создаём объект нашей модели
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
            
            $posts = new Application_Model_DbTable_Post();
            
            $paginator = Zend_Paginator::factory($posts->GetPostByCategoryId($id));      
            $paginator->setCurrentPageNumber($this->_getParam('page', 1)); // page number
            $paginator->setItemCountPerPage(10); // number of items to show per page
            
            $this->view->post = $paginator;
            $this->view->paginator = $paginator;
			Zend_Registry::set('current_category_id', $id);
        }
        
    }

    public function selectpostAction()
    {
        // action body
        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            $current_posts = new Application_Model_DbTable_Post();
            $current_post = $current_posts->GetById($id); 
            
            if (!$current_post) {
                throw new Zend_Controller_Dispatcher_Exception();
            }           
            
            $current_posts->IncReview($id);

            $categorys = new Application_Model_DbTable_Indexcategory();
            $categorys = $categorys->GetCategorys($this->_groupid);

            $current_categorys = new Application_Model_DbTable_Indexcategory();
            $current_category = $current_categorys->GetCategoryById($current_post->categoryid); 
            $this->view->indexcategory = Array('current_category' => $current_category, 'list' => $categorys);  

            $similar_posts = new Application_Model_DbTable_Post();
            $similar_post = $similar_posts->GetPostByCategoryIdLimit($current_post->categoryid, 5); 

            $this->view->post = Array('current_post' => $current_post, 'similar_post' => $similar_post);  
			Zend_Registry::set('current_category_id', $current_post->categoryid);			
        }
    }

    public function supportAction()
    {
        $form = new Application_Form_Support();
        $this->view->form = $form; 	

		$Indexcategorys = new Application_Model_DbTable_Indexcategory();
        $this->view->indexcategory = $Indexcategorys->GetCategorys($this->_groupid);		
        
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();
             
            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $email = $form->getValue('email');
                $title = $form->getValue('title');
                $text = $form->getValue('text');
        
                $this->SendEmail($email, 'webmaster@provacancy.ru', $email, $title, $text);
                // Используем библиотечный helper для редиректа на action = index
                $this->_helper->redirector('index');
            } else {
                // Если форма заполнена неверно,
                // используем метод populate для заполнения всех полей
                // той информацией, которую ввёл пользователь
                $form->populate($formData);
            }
        }       
    }

    private function SendEmail($emailFrom, $emailTo, $name, $title, $text)
    {
        $mail = new Zend_Mail('UTF-8');
        $mail->setBodyText($text);
        $mail->setFrom($emailFrom, $name);
        $mail->addTo($emailTo, 'user_support');
        $mail->setSubject($title);
        $mail->send();
    }

    public function searchAction()
    {
                      
    }

    public function addbigAction()
    {
        $form = new Application_Form_Addbig();
             
        $categorys = new Application_Model_DbTable_Indexcategory();
        $form->category->addMultiOption(0, 'Выберите рубрику');
        foreach ($categorys->GetIndexCategorys($this->_groupid) as $category) {
            $form->category->addMultiOption($category->category_id, $category->category_name);
        }      
        
        $this->view->form = $form;

        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            $url = $this->getRequest()->getParam('url');
			if ($url != '') {
				$form->url->setValue($url);
			}
			if ($form->isValid($formData)) {
				for ($i = 0; $i < 5; $i += 1) {
					$this->addPostItem($i, $form);
				}
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }           
    }
	
	public function addPostItem($item, $form)
    {
		$category = $form->getValue('category');
        $title = $form->getValue('title_'.$item);
        $text = $form->getValue('text_'.$item) . "\r\n" . $form->getValue('contact_'.$item);
        $price = $form->getValue('price_'.$item);

        $user_id = $this->GetCurrentUserId();
        
        $post = new Application_Model_DbTable_Post();
        $post->AddPost($category, $title, $text, $price, $user_id); 
    }

    public function changecityAction()
    {
    
    }

    public function mailerAction()
    {
        $form = new Application_Form_Support();
        $this->view->form = $form;   
        
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();
             
            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $email = $form->getValue('email');
                $title = $form->getValue('title');
                $text = $form->getValue('text');
        
                $this->SendEmail('webmaster@dprovacancy.ru', $email, $email, $title, $text);
                $this->_helper->redirector('mailer');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function importdataAction()
    {
        // Создаём форму
        $form = new Application_Form_Importdata();
             
        //Настройка формы 
        
        $citys = new Application_Model_DbTable_City();
        $form->city->addMultiOption(0, 'Выберите город');
        foreach ($citys->fetchAll() as $city) {
            $form->city->addMultiOption($city['id'], $city['name']);
        }       
        
        // Передаём форму в view
        $this->view->form = $form;  
        
        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();
             
            // Если форма заполнена верно
            if ($form->isValid($formData)) {
                $city = $form->getValue('city');
                $user_id = $this->GetCurrentUserId();
                
                $post = new Application_Model_DbTable_Post();
                $categorys = new Application_Model_DbTable_Indexcategory();
                foreach ($categorys->GetIndexCategorys($this->_groupid) as $categoryitem) {
                  if ($categoryitem['linkwithold'] != '0') {
                      $number = $categoryitem['linkwithold'];
                      $category = $categoryitem['category_id'];
                      $path = "../docs/".$number.".dat";
                      if (is_file($path)) { 
                          $lines=file($path); 
                          $count=count($lines); 
                          $i = 0;                   
                          while ($i < $count) {  
                            $dt=explode("|", $lines[$i]);
                            $title = $dt[3];
                            $text = $dt[5];
                            $price = $dt[22];
                            $valid = $dt[6];
                            if ($post->CheckExistPost($text) == false) {
                                $post->AddPost($category, $city, $title, $text, $price, $valid, $user_id);
                            }                   
                            $i = $i + 1;
                         }
                      }
                  }
                }
                $this->_helper->redirector('index');
            } else {
                $form->populate($formData);
            }
        }       
    }

    public function generatesitemapAction()
    {
        $this->_helper->layout->disableLayout();
        $post = new Application_Model_DbTable_Post();
        $this->view->post = $post->GetPosts();
        
        $blog = new Application_Model_DbTable_Blog();
        $this->view->blog = $blog->GetBlogs();      
    }

    public function blogAction()
    {
        $blogs = new Application_Model_DbTable_Blog();
            
        $paginator = Zend_Paginator::factory($blogs->GetBlogs());      
        $paginator->setCurrentPageNumber($this->_getParam('page', 1)); // page number
        $paginator->setItemCountPerPage(7); // number of items to show per page
            
        $this->view->blog = $paginator;
        $this->view->paginator = $paginator;
		
		$Indexcategorys = new Application_Model_DbTable_Indexcategory();
        $this->view->indexcategory = $Indexcategorys->GetCategorys($this->_groupid);		
    }

    public function addblogAction()
    {
        $form = new Application_Form_Addblog();
        $this->view->form = $form;  
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if ($form->isValid($formData)) {

                $title = $form->getValue('title');
                $text = $form->getValue('text');
                
                $blog = new Application_Model_DbTable_Blog();
                $blog->AddBlog($title, $text);

                $this->_helper->redirector('blog');
            } else {
                $form->populate($formData);
            }
        }       
    }

    public function selectblogAction()
    {
        $id = $this->_getParam('id', 0);
        if ($id > 0) {
            $blogs = new Application_Model_DbTable_Blog();
            $blog = $blogs->GetBlogById($id);   
            $this->view->blog = $blog;      
        }
    }

    public function rssAction()
    {
        $this->_helper->layout->disableLayout();
        $post = new Application_Model_DbTable_Post();
        $this->view->post = $post->GetCountPosts(10);
    }

    public function agencyAction()
    {
        $Agencys = new Application_Model_DbTable_Agency();
            
        $paginator = Zend_Paginator::factory($Agencys->GetAgencys());      
        $paginator->setCurrentPageNumber($this->_getParam('page', 1)); // page number
        $paginator->setItemCountPerPage(30); // number of items to show per page
            
        $this->view->agency = $paginator;
        $this->view->paginator = $paginator;
		
		$Indexcategorys = new Application_Model_DbTable_Indexcategory();
        $this->view->indexcategory = $Indexcategorys->GetCategorys($this->_groupid); 		
    }

    public function addagencyAction()
    {
        $form = new Application_Form_Addagency();
        $this->view->form = $form;  
        
        if ($this->getRequest()->isPost()) {
        
            $formData = $this->getRequest()->getPost();
            
            if ($form->isValid($formData)) {
            
                $title = $form->getValue('title');
                $description = $form->getValue('description');
                $url = $form->getValue('url');
                $phone = $form->getValue('phone');
                $address = $form->getValue('address');
                
                $agencys = new Application_Model_DbTable_Agency();
                $agencys->AddAgency($title, $description, $url, $phone, $address);

                $this->_helper->redirector('agency');
            } else {
                $form->populate($formData);
            }
        }
    }

    public function addseocategoryAction()
    {
        // Создаём форму
        $form = new Application_Form_Addseocategory();
             
        //Настройка формы 
        
        $categorys = new Application_Model_DbTable_Categorygroup();
        $form->category->addMultiOption(0, 'Выберите категорию');
        foreach ($categorys->GetCategoryWithGroup() as $category) {
            $form->category->addMultiOption($category['category_id'], $category['name'].' - '.$category['category_name']);
        }   
        
        // Передаём форму в view
        $this->view->form = $form;  
        
        // Если к нам идёт Post запрос
        if ($this->getRequest()->isPost()) {
            // Принимаем его
            $formData = $this->getRequest()->getPost();
             
            // Если форма заполнена верно
            if ($form->isValid($formData)) {

                $category = $form->getValue('category');
                $title = $form->getValue('title');
                $description = $form->getValue('description');
                $texttop = $form->getValue('texttop');
                $textleft = $form->getValue('textleft');  
                $user_id = $this->GetCurrentUserId();
                
                $post = new Application_Model_DbTable_Seocategory();
                $post->AddSeo($category, Zend_Registry::get('city_id'), $title, $description, $texttop, $textleft);        
                
                $this->_helper->redirector('addseocategory');
            } else {
                $form->populate($formData);
            }
        }   
    }


}













































