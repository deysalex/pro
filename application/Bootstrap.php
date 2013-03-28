<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
   protected function _initAcl()
	    {
	        // Создаём объект Zend_Acl
	        $acl = new Zend_Acl();
	         
	        // Добавляем ресурсы нашего сайта,
	        // другими словами указываем контроллеры и действия
	         
	        // указываем, что у нас есть ресурс index
	        $acl->addResource('index');
	        $acl->addResource('add', 'index');
	         
	        $acl->addResource('edit', 'index');
	        $acl->addResource('delete', 'index');
			
	        $acl->addResource('ruls', 'index');	
	        $acl->addResource('postlist', 'index');			
	        $acl->addResource('selectpost', 'index');	
	        $acl->addResource('support', 'index');				
	        $acl->addResource('search', 'index');	
	        $acl->addResource('addbig', 'index');	
			$acl->addResource('changecity', 'index');	
			$acl->addResource('mailer', 'index');	
			$acl->addResource('importdata', 'index');	
			$acl->addResource('generatesitemap', 'index');	
			$acl->addResource('blog', 'index');	
			$acl->addResource('selectblog', 'index');	
			$acl->addResource('addblog', 'index');	
			$acl->addResource('rss', 'index');	
			$acl->addResource('agency', 'index');	
			$acl->addResource('addagency', 'index');	
			$acl->addResource('addseocategory', 'index');			
	        // указываем, что у нас есть ресурс error
	        $acl->addResource('error');
	        $acl->addResource('aut');
	         
	        // ресурс login является потомком ресурса auth
	        $acl->addResource('login', 'aut');
	        $acl->addResource('logout', 'aut');
	        $acl->addResource('registration', 'aut');				
	        $acl->addResource('message', 'aut');	
			$acl->addResource('office', 'aut');
			
			
			$acl->addResource('admin');
			$acl->addResource('addmailtemplate', 'admin');
			$acl->addResource('editmailtemplate', 'admin');
			$acl->addResource('mailtemplate', 'admin');
			$acl->addResource('sendmail', 'admin');
			
			
	        // далее переходим к созданию ролей, которых у нас 2:
	        // гость (неавторизированный пользователь)
	        $acl->addRole('guest');
	         
	        // администратор, который наследует доступ от гостя
	        $acl->addRole('admin', 'guest');
	        $acl->addRole('superadmin', 'admin');
			
	        // разрешаем гостю просматривать ресурс index
	        $acl->allow('guest', 'index', array('index', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'changecity', 'generatesitemap', 'blog', 'selectblog', 'rss', 'agency'));
	         
	        // разрешаем гостю просматривать ресурс auth и его подресурсы
	        $acl->allow('guest', 'aut', array('index', 'login', 'logout', 'registration', 'message'));
	         
	        // даём администратору доступ к ресурсам 'add', 'edit' и 'delete'
	        $acl->allow('admin', 'index', array('add', 'edit', 'delete', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'addbig', 'changecity', 'blog', 'agency', 'addagency'));
	        $acl->allow('admin', 'aut', array('index', 'login', 'logout', 'registration', 'message', 'office', 'changepass'));
	         
	        // разрешаем администратору просматривать страницу ошибок
			$acl->allow('superadmin', 'index', array('add', 'edit', 'delete', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'addbig', 'changecity', 'mailer', 'importdata','blog', 'addblog', 'addagency', 'addseocategory'));
	        $acl->allow('superadmin', 'admin', array('index','addmailtemplate', 'editmailtemplate', 'mailtemplate', 'sendmail'));	        
			$acl->allow('superadmin', 'error');
	         
	        // получаем экземпляр главного контроллера
	        $fc = Zend_Controller_Front::getInstance();
	         
	        // регистрируем плагин с названием AccessCheck, в который передаём
	        // на ACL и экземпляр Zend_Auth
	        $fc->registerPlugin(new Application_Plugin_AccessCheck($acl, Zend_Auth::getInstance()));
			
			$smtpConfig = array(  
				'host' => 'smtp.provacancy.ru',  
				'username' => 'webmaster@provacancy.ru',  
				'password' => 'OKXZ6fYV',  
				'port' => 25,  
				'auth' => 'login'  
			);

			$tr = new Zend_Mail_Transport_Smtp('smtp.provacancy.ru', $smtpConfig);
			Zend_Mail::setDefaultTransport($tr);
	    }
}

