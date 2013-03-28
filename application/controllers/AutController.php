<?php

class AutController extends Zend_Controller_Action
{

    private $m_strMessage = null;

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->_helper->redirector('login');
    }

    public function loginAction()
    {
            // проверяем, авторизирован ли пользователь
	    if (Zend_Auth::getInstance()->hasIdentity()) {
	        // если да, то делаем редирект, чтобы исключить многократную авторизацию
	        $this->_helper->redirector('index', 'index');
	    }
	     
	    // создаём форму и передаём её во view
	    $form = new Application_Form_Login();
	    $this->view->form = $form;
	     
	    // Если к нам идёт Post запрос
	    if ($this->getRequest()->isPost()) {
	        // Принимаем его
	        $formData = $this->getRequest()->getPost();
	         
	        // Если форма заполнена верно
	        if ($form->isValid($formData)) {
	            // Получаем адаптер подключения к базе данных
	            $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
	             
	            // указываем таблицу, где необходимо искать данные о пользователях
	            // колонку, где искать имена пользователей,
	            // а также колонку, где хранятся пароли
	            $authAdapter->setTableName('users')
	                ->setIdentityColumn('username')
	                ->setCredentialColumn('password');
	            // получаем введённые данные
	            $username = $this->getRequest()->getPost('username');
	            $password = $this->getRequest()->getPost('password');
	             
	            // подставляем полученные данные из формы
	            $authAdapter->setIdentity($username)
	                ->setCredential($password);
	             
	            // получаем экземпляр Zend_Auth
	            $auth = Zend_Auth::getInstance();
	             
	            // делаем попытку авторизировать пользователя
	            $result = $auth->authenticate($authAdapter);
	             
	            // если авторизация прошла успешно
	            if ($result->isValid()) {
	                // используем адаптер для извлечения оставшихся данных о пользователе
	                $identity = $authAdapter->getResultRowObject();
	                 
	                // получаем доступ к хранилищу данных Zend
	                $authStorage = $auth->getStorage();
	                 
	                // помещаем туда информацию о пользователе,
	                // чтобы иметь к ним доступ при конфигурировании Acl
	                $authStorage->write($identity);
	                 
	                // Используем библиотечный helper для редиректа
	                // на controller = index, action = index
	                $this->_helper->redirector('index', 'index');
	            } else {
	                $this->view->errMessage = 'Вы ввели неверное имя пользователя или неверный пароль';
	            }
	        }
	    }
    }

    public function logoutAction()
    {
            // уничтожаем информацию об авторизации пользователя
	    Zend_Auth::getInstance()->clearIdentity();
	     
	    // и отправляем его на главную
	    $this->_helper->redirector('index', 'index');
    }

    public function registrationAction()
    {
		// создаём форму и передаём её во view
	    $form = new Application_Form_Registration();
	    $this->view->form = $form;
		 
	    // Если к нам идёт Post запрос
	    if ($this->getRequest()->isPost()) {
	        // Принимаем его
	        $formData = $this->getRequest()->getPost();
	         
	        // Если форма заполнена верно		
	        if ($form->isValid($formData)) {
				$username = $form->getValue('username');
		        $email = $form->getValue('email');	
			    $password = $this->GenPassword(8);
			
				$usersTable = new Application_Model_DbTable_Users();
				if ($usersTable->CheckExistUsername($username)) {
				    $this->view->errMessage = "Пользователь с таким логином уже существует";
				} else if ($usersTable->CheckExistEmail($email)) {
				    $this->view->errMessage = "Email уже используется";				
				} else {
				    $usersTable->AddUser($username, $password, $email); 
				    $this->SendEmail($email, $username, $this->CreateEmailText($username, $password));
					$this->SendEmail('webmaster@provacancy.ru', $username, $this->CreateEmailText($username, $password));
					$this->_helper->redirector('login');
				}
	        } else {
	            $form->populate($formData);
	        }
	    }
    }

    private function make_seed()
    {
         list($usec, $sec) = explode(' ', microtime());
         return (float) $sec + ((float) $usec * 100000); 
    }

    private function GenPassword($pass_len)
    {
        //seed the random generator 
          mt_srand($this->make_seed()); 
         //create password 
          $password = ""; 
    
	      for ($loop = 0; $loop < $pass_len; $loop++) 
          { 
            switch(mt_rand(0, 2))
            { 
                case 0: $password .= mt_rand(0, 9);            break; // Number (0-9) 
                case 1: $password .= chr(mt_rand(97, 122));    break; // Alpha Lower (a-z) 
                case 2: $password .= chr(mt_rand(65, 90));    break; // Alpha Upper (A-Z) 
            }
          }
          return $password;
    }

    private function SendEmail($email, $name, $text)
    {
	    $mail = new Zend_Mail('UTF-8');
        $mail->setBodyText($text);
        $mail->setFrom('webmaster@provacancy.ru', 'provacancy');
        $mail->addTo($email, $name);
        $mail->setSubject('Регистрационные данные');
        $mail->send();
    }

    private function CreateEmailText($username, $password)
    {
	    $mailtemplates = new Application_Model_DbTable_Mailtemplate();
		$mailtemplate = $mailtemplates->GetById(2);
		$text=str_replace("username ", $username, $mailtemplate->text);
		$text=str_replace("password ", $password, $text);
		
		return $text;
    }

    public function messageAction()
    {
        $form = new Application_Form_Message();
		//$this->view->errMessage = $this->m_strMessage;
    }

    public function mailerAction()
    {
        $mailer = new Application_Model_DbTable_Mailer();
        foreach ($mailer->fetchAll() as $mail) {
		
		   $email = $mail->email;
		   $mail = $mail->name;
		   $text = "";
           SendEmail($email, $name, $text);
        }
    }

    public function officeAction()
    {
		$posts = new Application_Model_DbTable_Post();
			
		$paginator = Zend_Paginator::factory($posts->GetPostCurrentUser());      
        $paginator->setCurrentPageNumber($this->_getParam('page', 1)); // page number
        $paginator->setItemCountPerPage(30); // number of items to show per page
			
	    $this->view->post = $paginator;
	    $this->view->paginator = $paginator;
    }

    public function changepassAction()
    {
		$form = new Application_Form_Changepass();
	    $this->view->form = $form; 
        
		if ($this->getRequest()->isPost()) {
	        // Принимаем его
	        $formData = $this->getRequest()->getPost();
	         
	        // Если форма заполнена верно		
	        if ($form->isValid($formData)) {
				$password_old = $form->getValue('password_old');
		        $password_new = $form->getValue('password_new');	
			    $password_new2 = $form->getValue('password_new2');
				
				if ($password_new2 != $password_new) {
				    $this->view->errMessage = "Новый пароль не совпадает";	
				} else {
				    $user_id = -1;
		        	$pAuthIdentity = Zend_Auth::getInstance()->getIdentity();
                    if ($pAuthIdentity) {
		                $user_id = $pAuthIdentity->id;
						$users = new Application_Model_DbTable_Users();
						$users->ChangePassword($user_id, $password_new);
						
						$username = $pAuthIdentity->username;
						$this->SendEmail($pAuthIdentity->email, $username, $this->CreateEmailTextChangePassword($username, $password_new));
						
						$this->_helper->redirector('office');
                    }
				}	
	        } else {
	            $form->populate($formData);
	        }
	    }
    }
	
    private function CreateEmailTextChangePassword($username, $password)
    {
	    $mailtemplates = new Application_Model_DbTable_Mailtemplate();
		$mailtemplate = $mailtemplates->GetById(3);
		$text=str_replace("username ", $username, $mailtemplate->text);
		$text=str_replace("password ", $password, $text);
		
		return $text;
    }

}















