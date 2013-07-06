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
			$acl->addResource('stat', 'admin');
			$acl->addResource('listseo', 'admin');
			$acl->addResource('addseo', 'admin');
			$acl->addResource('editseo', 'admin');
			
			$acl->addResource('export');
			$acl->addResource('yandex', 'export');
			
			$acl->addResource('rezume');
			$acl->addResource('addrezume', 'rezume');	
			
			$acl->addResource('omsk');	
			$acl->addResource('automsk');		

			$acl->addResource('kemerovo');	
			$acl->addResource('autkemerovo');		

			$acl->addResource('krasnoyarsk');	
			$acl->addResource('autkrasnoyarsk');	
			
			$acl->addResource('novosibirsk');	
			$acl->addResource('autnovosibirsk');				
			
	        // далее переходим к созданию ролей, которых у нас 2:
	        // гость (неавторизированный пользователь)
	        $acl->addRole('guest');
	         
	        // администратор, который наследует доступ от гостя
	        $acl->addRole('admin', 'guest');
	        $acl->addRole('superadmin', 'admin');
			
	        // разрешаем гостю просматривать ресурс index
	        $acl->allow('guest', 'index', array('index', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'changecity', 'generatesitemap', 'blog', 'selectblog', 'rss', 'agency'));
			$acl->allow('guest', 'omsk', array('index', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'changecity', 'generatesitemap', 'blog', 'selectblog', 'rss', 'agency'));
			$acl->allow('guest', 'kemerovo', array('index', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'changecity', 'generatesitemap', 'blog', 'selectblog', 'rss', 'agency'));		
			$acl->allow('guest', 'krasnoyarsk', array('index', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'changecity', 'generatesitemap', 'blog', 'selectblog', 'rss', 'agency'));	
			$acl->allow('guest', 'novosibirsk', array('index', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'changecity', 'generatesitemap', 'blog', 'selectblog', 'rss', 'agency'));				
			$acl->allow('guest', 'export', array('index', 'yandex', 'ngs'));
			$acl->allow('guest', 'rezume', array('index', 'addrezume', 'rezume', 'listrezume'));
			$acl->allow('guest', 'error');
	         
	        // разрешаем гостю просматривать ресурс auth и его подресурсы
	        $acl->allow('guest', 'aut', array('index', 'login', 'logout', 'registration', 'message'));
			$acl->allow('guest', 'automsk', array('index', 'login', 'logout', 'registration', 'message'));
			$acl->allow('guest', 'autkemerovo', array('index', 'login', 'logout', 'registration', 'message'));		
			$acl->allow('guest', 'autkrasnoyarsk', array('index', 'login', 'logout', 'registration', 'message'));	
			$acl->allow('guest', 'autnovosibirsk', array('index', 'login', 'logout', 'registration', 'message'));	
	         
	        // даём администратору доступ к ресурсам 'add', 'edit' и 'delete'
	        $acl->allow('admin', 'index', array('add', 'edit', 'delete', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'addbig', 'changecity', 'blog', 'agency', 'addagency'));
			$acl->allow('admin', 'omsk', array('add', 'edit', 'delete', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'addbig', 'changecity', 'blog', 'agency', 'addagency'));
			$acl->allow('admin', 'kemerovo', array('add', 'edit', 'delete', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'addbig', 'changecity', 'blog', 'agency', 'addagency'));
			$acl->allow('admin', 'krasnoyarsk', array('add', 'edit', 'delete', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'addbig', 'changecity', 'blog', 'agency', 'addagency'));
			$acl->allow('admin', 'novosibirsk', array('add', 'edit', 'delete', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'addbig', 'changecity', 'blog', 'agency', 'addagency'));
			
	        $acl->allow('admin', 'aut', array('index', 'login', 'logout', 'registration', 'message', 'office', 'changepass', 'editpost', 'rezume', 'editrezume'));
			$acl->allow('admin', 'automsk', array('index', 'login', 'logout', 'registration', 'message', 'office', 'changepass', 'editpost', 'rezume', 'editrezume'));
			$acl->allow('admin', 'autkemerovo', array('index', 'login', 'logout', 'registration', 'message', 'office', 'changepass', 'editpost', 'rezume', 'editrezume'));		
			$acl->allow('admin', 'autkrasnoyarsk', array('index', 'login', 'logout', 'registration', 'message', 'office', 'changepass', 'editpost', 'rezume', 'editrezume'));	
			$acl->allow('admin', 'autnovosibirsk', array('index', 'login', 'logout', 'registration', 'message', 'office', 'changepass', 'editpost', 'rezume', 'editrezume'));				
	         
	        // разрешаем администратору просматривать страницу ошибок
			$acl->allow('superadmin', 'index', array('add', 'edit', 'delete', 'ruls', 'postlist', 'selectpost', 'support', 'search', 'addbig', 'changecity', 'mailer', 'importdata','blog', 'addblog', 'addagency', 'addseocategory'));
	        $acl->allow('superadmin', 'admin', array('index','addmailtemplate', 'editmailtemplate', 'mailtemplate', 'sendmail', 'stat', 'listseo', 'addseo', 'editseo'));	   
			$acl->allow('superadmin', 'export', array('index', 'yandex'));				
			$acl->allow('superadmin', 'error');
	         
	        // получаем экземпляр главного контроллера
	        $fc = Zend_Controller_Front::getInstance();
	         
	        // регистрируем плагин с названием AccessCheck, в который передаём
	        // на ACL и экземпляр Zend_Auth
	        $fc->registerPlugin(new Application_Plugin_AccessCheck($acl, Zend_Auth::getInstance()));


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
	    }
}

