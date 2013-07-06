﻿<?php

require_once 'IndexController.php';

class KemerovoController extends IndexController
{

    public function init()
    {
		Zend_Registry::set('aut_controller', 'autkemerovo');
		Zend_Registry::set('controller', 'kemerovo');
		Zend_Registry::set('city_id', 3);	
		Zend_Registry::set('city_name', 'Кемерово');
		Zend_Registry::set('title_prefix', 'Вакансии в Кемерово. Работа в Кемерово. PROVACANCY.RU. | '); 	
		Zend_Registry::set('logo_text', 'Вакансии в Кемерово'); 		
		Zend_Registry::set('seo_text', 'Работа в Кемерово'); 		
		Zend_Registry::set('top_text', 'Вакансии в Кемерово и Кемеровcкой области на сайте PROVACANCY.RU. Вся работа в Кемерово. Самые свежие, самые последние вакансии, от прямых работодателей и кадровых агентств!'); 
		Zend_Registry::set('buttom_text', 'Работа  в   Кемерово : легко найти
                На сайте PROVACANCY Вас ждет не только банк  вакансий  в   Кемерово , но и много другой полезной информации: новости рынка труда, обзоры, информационные материалы, каталог кадровых агентств и работодателей, советы по составлению резюме и т.д. Найти работу  в   Кемерово  несложно: для того, чтобы разместить  вакансию, Вам понадобится всего несколько минут. 
                PROVACANCY старается помочь всем и каждому независимо от социального статуса и семейного положения. Широкие возможности отбора  вакансий  на сайте помогут найти работу  в   Кемерово  без опыта, по совместительству, со свободным графиком, вахтовым методом - параметры поиска могут быть разными. Достойные работа и зарплата в лучших компаниях  в   Кемерово  ждут Вас!');
		Zend_Registry::set('left_text', 'Работа, резюме и вакансии в Кемерово на PROVACANCY.RU! Мы предлагаем сервис поиска работы. Соискателям PROVACANCY.RU позволяет найти работу в Кемерово и регионах. Перспективная работа на PROVACANCY.RU. Работа в Кемерово на PROVACANCY.RU - не просто job-сайт или биржа труда, это качественная база вакансий Кемерово и лучший сервис для поиска работы! Работа в Кемерово - PROVACANCY.RU Мы работаем, чтобы Вы работали! '); 
		Zend_Registry::set('current_category_id', 0); 		
    }


}

