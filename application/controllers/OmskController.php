﻿<?php

require_once 'IndexController.php';

class OmskController extends IndexController
{

    public function init()
    {
		Zend_Registry::set('aut_controller', 'automsk');
		Zend_Registry::set('controller', 'omsk');
		Zend_Registry::set('city_id', 7);	
		Zend_Registry::set('city_name', 'Омск');
		Zend_Registry::set('title_prefix', 'Вакансии в Омске. Работа в Омске. PROVACANCY.RU.ru. | '); 	
		Zend_Registry::set('logo_text', 'Вакансии в Омске'); 		
		Zend_Registry::set('seo_text', 'Работа в Омске'); 		
		Zend_Registry::set('top_text', 'Вакансии в Омске и Омской области на сайте PROVACANCY.RU. Вся работа в Омске. Самые свежие, самые последние вакансии, от прямых работодателей и кадровых агентств! '); 
		Zend_Registry::set('buttom_text', 'Работа в Омске : легко найти На сайте PROVACANCY.RU Вас ждет не только банк вакансий в Омске , но и много другой полезной информации: новости рынка труда, обзоры, информационные материалы, каталог кадровых агентств и работодателей, советы по составлению резюме и т.д. Найти работу в Омске несложно: для того, чтобы разместить вакансию, Вам понадобится всего несколько минут. PROVACANCY старается помочь всем и каждому независимо от социального статуса и семейного положения. Широкие возможности отбора вакансий на сайте помогут найти работу в Омске без опыта, по совместительству, со свободным графиком, вахтовым методом - параметры поиска могут быть разными. Достойные работа и зарплата в лучших компаниях в Омске ждут Вас! ');
		Zend_Registry::set('left_text', 'Работа, резюме и вакансии в Омске на PROVACANCY.RU! Мы предлагаем сервис поиска работы. Соискателям PROVACANCY.RU позволяет найти работу в Омске и регионах. Перспективная работа на PROVACANCY.RU. Работа в Омске на PROVACANCY.RU - не просто job-сайт или биржа труда, это качественная база вакансий Омска и лучший сервис для поиска работы! Работа в Омске - PROVACANCY.RU Мы работаем, чтобы Вы работали! '); 
		Zend_Registry::set('current_category_id', 0); 			
    }

}