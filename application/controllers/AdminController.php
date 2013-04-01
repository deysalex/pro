<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
    }

    public function addmailtemplateAction()
    {
        $form = new Application_Form_Addmailtemplate();	       
	    $this->view->form = $form;	
	
	    if ($this->getRequest()->isPost()) {
	        $formData = $this->getRequest()->getPost();	     
	        if ($form->isValid($formData)) {
			
	            $name = $form->getValue('name');
	            $text = $form->getValue('text');				
	            
				$mailtempalte = new Application_Model_DbTable_Mailtemplate();
				$mailtempalte->Add($name, $text);		
			    
				$this->_helper->redirector('mailtemplate');
	        } else {
	            $form->populate($formData);
	        }
	    }		
    }

    public function mailtemplateAction()
    {
		$mailtemplates = new Application_Model_DbTable_Mailtemplate();
		$mailtemplatelist = $mailtemplates->GetAll();
		$this->view->mailtemplate = $mailtemplatelist;
    }

    public function editmailtemplateAction()
    {
	    $id = $this->_getParam('id', 0);
	    if ($id > 0) {	
			$mailtemplates = new Application_Model_DbTable_Mailtemplate();
			$mailtemplate = $mailtemplates->GetById($id);
			
			$form = new Application_Form_Addmailtemplate();
			$form->name->setValue($mailtemplate->name);
			$form->text->setValue($mailtemplate->text);
			
			$this->view->form = $form;
			
			if ($this->getRequest()->isPost()) {	
				$formData = $this->getRequest()->getPost();	     
				if ($form->isValid($formData)) {
			
					$name = $form->getValue('name');
					$text = $form->getValue('text');				
	            
					$mailtempalte = new Application_Model_DbTable_Mailtemplate();
					$mailtempalte->Edit($id, $name, $text);		
			    
					$this->_helper->redirector('mailtemplate');
				} else {
					$form->populate($formData);
				}
			} 
		}
    }

    public function sendmailAction()
    {
        $form = new Application_Form_Sendmail();	

		$mailtemplates = new Application_Model_DbTable_Mailtemplate();
		$form->template->addMultiOption(0, 'Выберите шаблон');
        foreach ($mailtemplates->GetAll() as $mailtemplate) {
            $form->template->addMultiOption($mailtemplate->id, $mailtemplate->name);
        }
		
	    $this->view->form = $form;	
	
	    if ($this->getRequest()->isPost()) {
	        $formData = $this->getRequest()->getPost();	     
	        if ($form->isValid($formData)) {
			
	            $email = $form->getValue('email');
	            $templateid = $form->getValue('template');	

				$mailtemplate = $mailtemplates->GetById($templateid);
	            
				$this->SendEmail($email, $email, $mailtemplate->text);
				
				$this->_helper->redirector('sendmail');
	        } else {
	            $form->populate($formData);
	        }
	    }
    }

    private function SendEmail($email, $name, $text)
    {
	    $mail = new Zend_Mail('UTF-8');
        $mail->setBodyText($text);
        $mail->setFrom('webmaster@provacancy.ru', 'Алексей');
        $mail->addTo($email, $name);
        $mail->setSubject('Вакансии');
        $mail->send();
    }

    public function statAction()
    {
		$citys = new Application_Model_DbTable_City();
		$city = $citys->GetStat();
		
		$this->view->city = $city;
    }


}











