<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    // Создаём объект нашей модели
		$Indexcategorys = new Application_Model_DbTable_Indexcategory();
		$this->view->indexcategory = $Indexcategorys->GetCategorys();;  
	   
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
    }

    public function addAction()
    {
        // Создаём форму
        $form = new Application_Form_Add();
	         
		//Настройка формы 
	    
		$categorys = new Application_Model_DbTable_Indexcategory();
		$form->category->addMultiOption(0, 'Выберите рубрику');
        foreach ($categorys->GetIndexCategorys() as $category) {
            $form->category->addMultiOption($category->category_id, $category->category_name);
        }
		
		/*$citys = new Application_Model_DbTable_City();
		$form->city->addMultiOption(0, 'Выберите город');
        foreach ($citys->fetchAll() as $city) {
            $form->city->addMultiOption($city['id'], $city['name']);
        }*/		
		
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
	            $text = $form->getValue('text');
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
            // Создаём форму
	    $form = new Application_Form_Movie();
	     
	    // Указываем текст для submit
	    $form->submit->setLabel('Сохранить');
	    $this->view->form = $form;
	     
	    // Если к нам идёт Post запрос
	    if ($this->getRequest()->isPost()) {
	        // Принимаем его
	        $formData = $this->getRequest()->getPost();
	         
	        // Если форма заполнена верно
	        if ($form->isValid($formData)) {
	            // Извлекаем id
	            $id = (int)$form->getValue('id');
	             
	            // Извлекаем режиссёра
	            $director = $form->getValue('director');
	             
	            // Извлекаем название фильма
	            $title = $form->getValue('title');
	             
	            // Создаём объект модели
	            $movies = new Application_Model_DbTable_Movies();
	             
	            // Вызываем метод модели updateMovie для обновления новой записи
	            $movies->updateMovie($id, $director, $title);
	             
	            // Используем библиотечный helper для редиректа на action = index
	            $this->_helper->redirector('index');
	        } else {
	            $form->populate($formData);
	        }
	    } else {
	        // Если мы выводим форму, то получаем id фильма, который хотим обновить
	        $id = $this->_getParam('id', 0);
	        if ($id > 0) {
	            // Создаём объект модели
	            $movies = new Application_Model_DbTable_Movies();
	             
	            // Заполняем форму информацией при помощи метода populate
	            $form->populate($movies->getMovie($id));
	        }
	    }
    }

    public function deleteAction()
    {
            // Если к нам идёт Post запрос
	    if ($this->getRequest()->isPost()) {
	        // Принимаем значение
	        $del = $this->getRequest()->getPost('del');
	         
	        // Если пользователь подтвердил своё желание удалить запись
	        if ($del == 'Да') {
	            // Принимаем id записи, которую хотим удалить
	            $id = $this->getRequest()->getPost('id');
	             
	            // Создаём объект модели
	            $movies = new Application_Model_DbTable_Movies();
	             
	            // Вызываем метод модели deleteMovie для удаления записи
	            $movies->deleteMovie($id);
	        }
	         
	        // Используем библиотечный helper для редиректа на action = index
	        $this->_helper->redirector('index');
	    } else {
	        // Если запрос не Post, выводим сообщение для подтверждения
	        // Получаем id записи, которую хотим удалить
	        $id = $this->_getParam('id');
	         
	        // Создаём объект модели
	        $movies = new Application_Model_DbTable_Movies();
	         
	        // Достаём запись и передаём в view
	        $this->view->movie = $movies->getMovie($id);
	    }
    }

    public function rulsAction()
    {
        // Создаём форму
        $form = new Application_Form_Ruls();
	     
	    // Передаём форму в view
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
	    }
		
    }

    public function selectpostAction()
    {
        // action body
		$id = $this->_getParam('id', 0);
	    if ($id > 0) {
            $posts = new Application_Model_DbTable_Post();
			$post = $posts->GetPostById($id);	
            $this->view->post = $post;
			
			$posts->IncReview($id);

			$categorys = new Application_Model_DbTable_Indexcategory();
            $this->view->indexcategory = $categorys->GetCategoryById($post->categoryid);		

			
	    }
    }

    public function supportAction()
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
	    $form = new Application_Form_Search();
	    $this->view->form = $form; 

        if ($this->getRequest()->isPost()) {
	        // Принимаем его
	        $formData = $this->getRequest()->getPost();
	         
	        // Если форма заполнена верно
	        if ($form->isValid($formData)) {
	            $text = $form->getValue('text');
				$posts = new Application_Model_DbTable_Post();
	            $this->view->post = $posts->SearchText($text);
	        } else {
	            // Если форма заполнена неверно,
	            // используем метод populate для заполнения всех полей
	            // той информацией, которую ввёл пользователь
	            $form->populate($formData);
	        }
	    }				
    }

    public function addbigAction()
    {
        $form = new Application_Form_Addbig();
	         
		//Настройка формы 
	    
		$categorys = new Application_Model_DbTable_Categorygroup();
		$form->category->addMultiOption(0, 'Выберите рубрику');
        foreach ($categorys->GetCategoryWithGroup() as $category) {
            $form->category->addMultiOption($category['category_id'], $category['name'].' - '.$category['category_name']);
        }
		
		$citys = new Application_Model_DbTable_City();
		$form->city->addMultiOption(0, 'Выберите город');
        foreach ($citys->fetchAll() as $city) {
            $form->city->addMultiOption($city['id'], $city['name']);
        }		
		
		// Передаём форму в view
	    $this->view->form = $form;

	    if ($this->getRequest()->isPost()) {
	        // Принимаем его
	        $formData = $this->getRequest()->getPost();
	         
	        // Если форма заполнена верно
	        if ($form->isValid($formData)) {

	            $category = $form->getValue('category');
				$city = $form->getValue('city');
				$valid = $form->getValue('valid');	
				$user_id = $this->GetCurrentUserId();
				 
	            $post = new Application_Model_DbTable_Post();
				$categoryTable = new Application_Model_DbTable_Indexcategory();
				
				$title = $form->getValue('title1');
	            $text = $form->getValue('text1');
				$price = $form->getValue('price1');
				
				$post->AddPost($category, $city, $title, $text, $price, $valid, $user_id);
				$categoryTable->IncCount($category);
				
				$title = $form->getValue('title2');
	            $text = $form->getValue('text2');
				$price = $form->getValue('price2');
				
				$post->AddPost($category, $city, $title, $text, $price, $valid, $user_id);		
                $categoryTable->IncCount($category);
				
				$title = $form->getValue('title3');
	            $text = $form->getValue('text3');
				$price = $form->getValue('price3');
				
				$post->AddPost($category, $city, $title, $text, $price, $valid, $user_id);	
                $categoryTable->IncCount($category);
				
				$title = $form->getValue('title4');
	            $text = $form->getValue('text4');
				$price = $form->getValue('price4');
				
				$post->AddPost($category, $city, $title, $text, $price, $valid, $user_id);	
                $categoryTable->IncCount($category);
				
				$title = $form->getValue('title5');
	            $text = $form->getValue('text5');
				$price = $form->getValue('price5');
				
				$post->AddPost($category, $city, $title, $text, $price, $valid, $user_id);					
                $categoryTable->IncCount($category);
				
	            $this->_helper->redirector('index');
	        } else {
	            $form->populate($formData);
	        }
	    }			
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
                foreach ($categorys->GetIndexCategorys() as $categoryitem) {
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
    }

    public function addblogAction()
    {
        $form = new Application_Form_Addblog();
	    $this->view->form = $form;	
		
	    if ($this->getRequest()->isPost()) {
	        // Принимаем его
	        $formData = $this->getRequest()->getPost();
	         
	        // Если форма заполнена верно
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
				$city = new Zend_City_City();	

				$user_id = $this->GetCurrentUserId();
	            
				$post = new Application_Model_DbTable_Seocategory();
				$post->AddSeo($category, $city->getId(), $title, $description, $texttop, $textleft);		
			    
				$this->_helper->redirector('addseocategory');
	        } else {
	            $form->populate($formData);
	        }
	    }	
    }


}













































