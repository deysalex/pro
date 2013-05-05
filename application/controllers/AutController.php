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
	    if (Zend_Auth::getInstance()->hasIdentity()) {
	        $this->_helper->redirector('index', 'index');
	    }
	     
	    $form = new Application_Form_Login();
	    $this->view->form = $form;
	     
	    if ($this->getRequest()->isPost()) {
	        $formData = $this->getRequest()->getPost();
	         
	        if ($form->isValid($formData)) {
	            $authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
	             
	            $authAdapter->setTableName('users')
	                ->setIdentityColumn('username')
	                ->setCredentialColumn('password');

	            $username = $this->getRequest()->getPost('username');
	            $password = $this->getRequest()->getPost('password');

	            $authAdapter->setIdentity($username)->setCredential($password);
	             
	            $auth = Zend_Auth::getInstance();
	            $result = $auth->authenticate($authAdapter);
	             
	            if ($result->isValid()) {
	                $identity = $authAdapter->getResultRowObject();
	                $authStorage = $auth->getStorage();
	                 
	                $authStorage->write($identity);
	                 
	                $this->_helper->redirector('index', 'index');
	            } else {
	                $this->view->errMessage = 'Вы ввели неверное имя пользователя или неверный пароль';
	            }
	        }
	    }
    }

    public function logoutAction()
    {
	    Zend_Auth::getInstance()->clearIdentity();
	    $this->_helper->redirector('index', 'index');
    }

    public function registrationAction()
    {
	    $form = new Application_Form_Registration();
	    $this->view->form = $form;
		 
	    if ($this->getRequest()->isPost()) {
	        $formData = $this->getRequest()->getPost();		
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
	        $formData = $this->getRequest()->getPost();	
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

    public function editpostAction()
    {
	    $id = $this->_getParam('id', 0);
	    if ($id > 0) {	
			$posts = new Application_Model_DbTable_Post();
			$post = $posts->GetById($id);
			
			if (!$post) {
				throw new Zend_Controller_Dispatcher_Exception();
			}
			
			if ($this->checkAccess($post->user_id)) {
				$form = new Application_Form_Editpost();
				$form->title->setValue($post->title);
				$form->text->setValue(str_replace("<br /> ","\r\n",$post->text));
				$form->price->setValue($post->price);
				$this->view->form = $form;
			
				if ($this->getRequest()->isPost()) {	
					$formData = $this->getRequest()->getPost();	     
					if ($form->isValid($formData)) {
						$title = $form->getValue('title');
						$text = $form->getValue('text');
						$price = $form->getValue('price');

						$posts->Edit($id, $title, $text, $price);		
						$this->_helper->redirector('office');
					} else {
						$form->populate($formData);
					}
				} 
			}
		}
    }

    private function checkAccess($user_id)
    {
		$pAuthIdentity = Zend_Auth::getInstance()->getIdentity();
		return $pAuthIdentity->id == $user_id;
    }

    public function rezumeAction()
    {
		$rezumes = new Application_Model_DbTable_Rezume();
			
		$paginator = Zend_Paginator::factory($rezumes->GetForCurrentUser());      
        $paginator->setCurrentPageNumber($this->_getParam('page', 1)); // page number
        $paginator->setItemCountPerPage(30); // number of items to show per page
			
	    $this->view->rezume = $paginator;
	    $this->view->paginator = $paginator;
    }

    public function editrezumeAction()
    {
	    $id = $this->_getParam('id', 0);
	    if ($id > 0) {	
			$rezumes = new Application_Model_DbTable_Rezume();
			$rezume = $rezumes->GetById($id);
			
			if (!$rezume) {
				throw new Zend_Controller_Dispatcher_Exception();
			}
			
			if ($this->checkAccess($rezume->user_id)) {
			
				$form = new Application_Form_Editrezume();
				
				$form->title->setValue($rezume->title);
				$form->about->setValue(str_replace("<br /> ","\r\n", $rezume->about));
				$form->education->setValue(str_replace("<br /> ","\r\n", $rezume->education));
				$form->skills->setValue(str_replace("<br /> ","\r\n", $rezume->skills));
				$form->experience->setValue(str_replace("<br /> ","\r\n", $rezume->experience));
				$form->other->setValue(str_replace("<br /> ","\r\n", $rezume->other));
				$form->contacts->setValue(str_replace("<br /> ","\r\n", $rezume->contacts));
				
				$this->view->form = $form;
			
				if ($this->getRequest()->isPost()) {	
					$formData = $this->getRequest()->getPost();	     
					if ($form->isValid($formData)) {

						$data = array(
							'title' => $form->getValue('title'),
							'about' => $form->getValue('about'),    
							'education' => $form->getValue('education'),
							'skills' => $form->getValue('skills'),
							'experience' => $form->getValue('experience'),
							'other' => $form->getValue('other'),
							'contacts' => $form->getValue('contacts'),
						);
						$rezumes->Edit($id, $data);	
						
						$this->_helper->redirector('rezume');
					} else {
						$form->populate($formData);
					}
				} 
			}
		}
    }


}





















