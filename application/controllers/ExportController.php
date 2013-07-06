<?php

class ExportController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        // action body
    }

    public function yandexAction()
    {
        $this->_helper->layout->disableLayout();
        
        $categories = new Application_Model_DbTable_Indexcategory();

        $createdDate = new Zend_Date(); 
    
        $sitemap_options = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getApplication()->getOption('sitemap');
        $sitemap_url = $sitemap_options['url']; 
        
		$citys = new Application_Model_DbTable_City();
        
        //------------------------------------------------------------
        
        $xml = new DomDocument('1.0', 'utf-8');
        $source = $xml->appendChild($xml->createElement('source'));
 
        $urlAttr1 = $xml->createAttribute("creation-time");
        $urlAttr1->appendChild($xml->createTextNode($createdDate->toString("YYYY-MM-dd HH:mm:ss 'GMT+7'")));
 
        $idAttr2 = $xml->createAttribute("host");
        $idAttr2->appendChild($xml->createTextNode($sitemap_url));
    
        $source->appendChild($urlAttr1);
        $source->appendChild($idAttr2);
    
        $vacancies = $source->appendChild($xml->createElement('vacancies'));

        foreach($citys->GetAll() as $city) {
		
		    $posts = new Application_Model_DbTable_Post();
			$posts = $posts->GetAllToExportYandex($city->id);
			foreach($posts as $post) {
				$post_date = new Zend_Date($post->date);
            
				$vacancie = $vacancies->appendChild($xml->createElement('vacancy'));
				$url = $vacancie->appendChild($xml->createElement('url'));
				$url->appendChild($xml->createTextNode($sitemap_url.$city->controller.'/selectpost/id/'.$post->id));
            
				$create_date = $vacancie->appendChild($xml->createElement('creation-date'));
				$create_date->appendChild($xml->createTextNode($post_date->toString("YYYY-MM-dd HH:mm:ss 'GMT+7'")));
            
				$category = $vacancie->appendChild($xml->createElement('category'));
				$industry = $category->appendChild($xml->createElement('industry'));
				$industry->appendChild($xml->createTextNode($categories->GetCategoryById($post->categoryid)->category_name));
            
				$job_name = $vacancie->appendChild($xml->createElement('job-name'));
				$job_name->appendChild($xml->createTextNode($post->title));
            
				$description = $vacancie->appendChild($xml->createElement('description'));
				$description->appendChild($xml->createTextNode(str_replace("<br /> "," ",$post->text)));
            
				$addresses = $vacancie->appendChild($xml->createElement('addresses'));
				$addresse = $addresses->appendChild($xml->createElement('address'));
				$location = $addresse->appendChild($xml->createElement('location'));
				$location->appendChild($xml->createTextNode($city->name));
            
				$anonymous_company = $vacancie->appendChild($xml->createElement('anonymous-company'));
				$description = $anonymous_company->appendChild($xml->createElement('description'));
			}
		}

        $xml->save("../yandex.xml");
            
    }

    public function ngsAction()
    {
		$this->_helper->layout->disableLayout();
		if ($this->getRequest()->isGet()) {
            $url = $this->getRequest()->getParam('url');
			$this->view->title = $url;
        }
    }


}





