<?php

require_once 'IndexController.php';

class KrasnoyarskController extends IndexController
{

    public function init()
    {
        Zend_Registry::set('aut_controller', 'autkrasnoyarsk');
		Zend_Registry::set('controller', 'krasnoyarsk');
        Zend_Registry::set('city_id', 6);   
        Zend_Registry::set('city_name', 'Красноярск'); 
		Zend_Registry::set('title_prefix', 'Вакансии в Красноярске. Работа в Красноярске. KRASNOYARSK.PROVACANCY.RU.ru. | '); 	
		Zend_Registry::set('logo_text', 'Вакансии в Красноярске'); 		
		Zend_Registry::set('seo_text', 'Работа в Красноярске'); 		
		Zend_Registry::set('top_text', 'Вакансии в Красноярске и Красноярской области на сайте KRASNOYARSK.PROVACANCY.RU. Вся работа в Красноярске. Самые свежие, самые последние вакансии, от прямых работодателей и кадровых агентств! '); 
		Zend_Registry::set('buttom_text', 'Работа в Красноярске : легко найти На сайте KRASNOYARSK.PROVACANCY.RU Вас ждет не только банк вакансий в Красноярске , но и много другой полезной информации: новости рынка труда, обзоры, информационные материалы, каталог кадровых агентств и работодателей, советы по составлению резюме и т.д. Найти работу в Красноярске несложно: для того, чтобы разместить вакансию, Вам понадобится всего несколько минут. ProVacancy старается помочь всем и каждому независимо от социального статуса и семейного положения. Широкие возможности отбора вакансий на сайте помогут найти работу в Красноярске без опыта, по совместительству, со свободным графиком, вахтовым методом - параметры поиска могут быть разными. Достойные работа и зарплата в лучших компаниях в Красноярске ждут Вас! ');
		Zend_Registry::set('left_text', 'Работа, резюме и вакансии в Красноярске на KRASNOYARSK.PROVACANCY.RU! Мы предлагаем сервис поиска работы. Соискателям KRASNOYARSK.PROVACANCY.RU позволяет найти работу в Красноярске и регионах. Перспективная работа на KRASNOYARSK.PROVACANCY.RU. Работа в Красноярске на KRASNOYARSK.PROVACANCY.RU - не просто job-сайт или биржа труда, это качественная база вакансий Красноярска и лучший сервис для поиска работы! Работа в Красноярске - KRASNOYARSK.PROVACANCY.RU Мы работаем, чтобы Вы работали! '); 
		Zend_Registry::set('current_category_id', 0); 		
    }


}

